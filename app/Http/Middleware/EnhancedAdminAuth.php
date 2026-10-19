<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class EnhancedAdminAuth
{
    /**
     * Handle an incoming request with enhanced security checks
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        // Check 1: Basic authentication
        if (!Auth::guard('admin')->check()) {
            return $this->unauthorizedResponse($request, 'غير مصرح - يرجى تسجيل الدخول');
        }

        $user = Auth::guard('admin')->user();

        // Check 2: Account status
        if ($user->status ) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return $this->unauthorizedResponse($request, 'الحساب غير نشط - يرجى التواصل مع الإدارة');
        }

        // Check 3: Session fingerprinting (detect session hijacking)
        if (!$this->validateSessionFingerprint($request, $user)) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            // Log suspicious activity
            $this->logSecurityEvent($request, $user, 'session_hijacking_attempt');
            
            return $this->unauthorizedResponse($request, 'انتهت الجلسة - يرجى تسجيل الدخول مرة أخرى');
        }

        // Check 4: IP whitelist check (if enabled in config)
        if ($this->isIpWhitelistEnabled() && !$this->isIpAllowed($request)) {
            $this->logSecurityEvent($request, $user, 'ip_blocked');
            return $this->forbiddenResponse($request, 'عنوان IP غير مسموح');
        }

        // Check 5: Concurrent session check (prevent multiple logins)
        if ($this->isConcurrentSessionCheckEnabled() && !$this->validateConcurrentSession($request, $user)) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            $this->logSecurityEvent($request, $user, 'concurrent_session_violation');
            
            return $this->unauthorizedResponse($request, 'تم تسجيل الدخول من جهاز آخر - تم تسجيل خروجك');
        }

        // Check 6: Activity timeout (auto logout after inactivity)
        if ($this->isActivityTimeoutEnabled() && $this->isSessionExpired($user)) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return $this->unauthorizedResponse($request, 'انتهت الجلسة بسبب عدم النشاط');
        }

        // Update last activity timestamp
        $this->updateLastActivity($user);

        // Store security info in session
        $this->storeSessionSecurityData($request, $user);

        return $next($request);
    }

    /**
     * Validate session fingerprint
     */
    protected function validateSessionFingerprint(Request $request, $user): bool
    {
        $sessionFingerprint = Session::get('admin_fingerprint');
        
        if (!$sessionFingerprint) {
            // First request after login - set fingerprint
            $fingerprint = $this->generateFingerprint($request);
            Session::put('admin_fingerprint', $fingerprint);
            return true;
        }

        // Verify fingerprint matches
        $currentFingerprint = $this->generateFingerprint($request);
        return hash_equals($sessionFingerprint, $currentFingerprint);
    }

    /**
     * Generate session fingerprint based on user agent and other factors
     */
    protected function generateFingerprint(Request $request): string
    {
        $userAgent = $request->userAgent() ?? '';
        $acceptLanguage = $request->header('Accept-Language') ?? '';
        $userId = Auth::guard('admin')->id() ?? '';

        return hash('sha256', $userAgent . $acceptLanguage . $userId . config('app.key'));
    }

    /**
     * Check if IP whitelist is enabled
     */
    protected function isIpWhitelistEnabled(): bool
    {
        return config('admin.security.ip_whitelist_enabled', false);
    }

    /**
     * Check if current IP is in whitelist
     */
    protected function isIpAllowed(Request $request): bool
    {
        $currentIp = $request->ip();
        $whitelist = config('admin.security.ip_whitelist', []);

        // Allow localhost in development
        if (in_array($currentIp, ['127.0.0.1', '::1', 'localhost']) && app()->environment('local', 'development')) {
            return true;
        }

        return in_array($currentIp, $whitelist);
    }

    /**
     * Check if concurrent session check is enabled
     */
    protected function isConcurrentSessionCheckEnabled(): bool
    {
        return config('admin.security.prevent_concurrent_sessions', false);
    }

    /**
     * Validate concurrent session
     */
    protected function validateConcurrentSession(Request $request, $user): bool
    {
        $sessionId = Session::getId();
        $cacheKey = "admin_session_{$user->id}";

        $lastSessionId = Cache::get($cacheKey);

        if (!$lastSessionId) {
            // First session - store session ID
            Cache::put($cacheKey, $sessionId, now()->addHours(8));
            return true;
        }

        // Check if session ID matches
        return $lastSessionId === $sessionId;
    }

    /**
     * Check if activity timeout is enabled
     */
    protected function isActivityTimeoutEnabled(): bool
    {
        return config('admin.security.session_timeout_enabled', true);
    }

    /**
     * Check if session has expired due to inactivity
     */
    protected function isSessionExpired($user): bool
    {
        $lastActivity = Session::get('admin_last_activity');
        
        if (!$lastActivity) {
            return false;
        }

        $timeoutMinutes = config('admin.security.session_timeout_minutes', 30);
        $lastActivityTime = Carbon::parse($lastActivity);

        return $lastActivityTime->addMinutes($timeoutMinutes)->isPast();
    }

    /**
     * Update last activity timestamp
     */
    protected function updateLastActivity($user): void
    {
        Session::put('admin_last_activity', now()->toIso8601String());
        
        // Also update in database
        $user->last_activity = now();
        $user->last_ip = request()->ip();
        $user->saveQuietly();
    }

    /**
     * Store session security data
     */
    protected function storeSessionSecurityData(Request $request, $user): void
    {
        Session::put('admin_id', $user->id);
        Session::put('admin_role', $user->role ?? 'employee');
        Session::put('admin_login_time', now()->toIso8601String());
        Session::put('admin_ip', $request->ip());
    }

    /**
     * Log security events
     */
    protected function logSecurityEvent(Request $request, $user, string $event): void
    {
        try {
            $log = [
                'user_id' => $user->id,
                'event' => $event,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'created_at' => now()->toIso8601String(),
            ];

            // Store in cache for monitoring
            $cacheKey = "security_logs_{$user->id}";
            $logs = Cache::get($cacheKey, []);
            $logs[] = $log;
            
            // Keep only last 100 logs
            if (count($logs) > 100) {
                $logs = array_slice($logs, -100);
            }
            
            Cache::put($cacheKey, $logs, now()->addDays(7));

            // Log to file
            logger()->channel('security')->warning("Security Event: {$event}", $log);
        } catch (\Exception $e) {
            // Silently fail - don't break the application
        }
    }

    /**
     * Return unauthorized response
     */
    protected function unauthorizedResponse(Request $request, string $message): Response
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $message], 401);
        }

        return redirect()->route('login')->with('error', $message);
    }

    /**
     * Return forbidden response
     */
    protected function forbiddenResponse(Request $request, string $message): Response
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $message], 403);
        }

        return redirect()->route('login')->with('error', $message)->with('error_type', 'ip_blocked');
    }

}

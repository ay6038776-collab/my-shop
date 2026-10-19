<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Employee;
use App\Models\AdminLoginLog;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Login attempts tracking
     */
    protected int $maxLoginAttempts = 5;
    protected int $loginDecayMinutes = 15;

    public function __construct()
    {
        $this->maxLoginAttempts = config('admin.security.login_max_attempts', 5);
        $this->loginDecayMinutes = config('admin.security.login_decay_minutes', 15);
    }

    /**
     * تسجيل الدخول
     */
    public function login(Request $request)
    {
        // Check if account is locked
        if ($this->isAccountLocked($request)) {
            $retryAfter = RateLimiter::availableIn($this->throttleKey($request));
            
            return back()
                ->withInput(['email' => $request->email])
                ->withErrors([
                    'email' => "تم حظر المحاولة من عنوان IP هذا مؤقتاً. حاول مرة أخرى بعد {$retryAfter} ثانية."
                ]);
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt authentication using Employee model (admin guard)
        $employee = Employee::where('email', $credentials['email'])->first();

        if ($employee && Hash::check($credentials['password'], $employee->password)) {
            // Check if account is active
            if ($employee->status) {
                $this->logLoginAttempt($request, $employee, 'failed', 'account_inactive');
                
                return back()
                    ->withInput(['email' => $request->email])
                    ->withErrors([
                        'email' => 'الحساب غير نشط. يرجى التواصل مع الإدارة.'
                    ]);
            }

        
            // Login the employee
            Auth::guard('admin')->login($employee, $request->filled('remember'));
            // Regenerate session to prevent session fixation
            // $request->session()->invalidate();
            $request->session()->regenerate();

            // Log successful login
            $this->logLoginAttempt($request, $employee, 'success');

            // Clear login attempts
            RateLimiter::clear($this->throttleKey($request));

            // Store security data in session
            $this->storeSessionSecurityData($request, $employee);

            return redirect('admin/index')->with('success', 'مرحباً بك! تم تسجيل الدخول بنجاح');
        }

        // Failed login
        $this->logLoginAttempt($request, $employee, 'failed', 'invalid_credentials');

        // Increment attempts
        $this->hitThrottle($request);

        // Check if now locked
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), $this->maxLoginAttempts)) {
            $retryAfter = RateLimiter::availableIn($this->throttleKey($request));
            
            return back()
                ->withInput(['email' => $request->email])
                ->withErrors([
                    'email' => "تم تجاوز الحد الأقصى من المحاولات. حاول مرة أخرى بعد {$retryAfter} ثانية."
                ]);
        }

        $remainingAttempts = RateLimiter::remaining($this->throttleKey($request), $this->maxLoginAttempts);

        return back()
            ->withInput(['email' => $request->email])
            ->withErrors([
                'email' => 'الإيميل أو كلمة المرور غير صحيحة. ' . $remainingAttempts . ' محاولات متبقية.'
            ]);
    }

    /**
     * إنشاء حساب جديد (للأدمن)
     */
    public function register(Request $request)
    {
        // Only allow registration if not disabled
        if (config('admin.security.disable_registration', false)) {
            return redirect()->route('login')->with('error', 'التسجيل مغلق حالياً');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'password' => 'required|string|min:8|confirmed|strong_password',
        ]);

        // Create employee account
        $employee = Employee::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $request->input('role', 'employee'), // Default role
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        return redirect()->route('login')
            ->with('success', 'تم إنشاء الحساب بنجاح، برجاء تسجيل الدخول');
    }

    /**
     * تسجيل الخروج
     */
    public function logout(Request $request)
    {
        $user = Auth::guard('admin')->user();

        if ($user) {
            // Log logout
            $this->logLogout($user);

            // Clear concurrent session cache
            Cache::forget("admin_session_{$user->id}");
        }

        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('admin/login')->with('success', 'تم تسجيل الخروج بنجاح');
    }

    /**
     * Show Login Form
     */
    public function showLoginForm()
    {
        return view('show.auth.login');
    }

    /**
     * Update Avatar
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $user = Auth::guard('admin')->user();

        // Delete old avatar
        if ($user->avatar && file_exists(public_path('img/' . $user->avatar))) {
            unlink(public_path('img/' . $user->avatar));
        }

        // Save new avatar
        $filename = time() . '_' . Str::random(10) . '.' . $request->avatar->extension();
        $request->avatar->move(public_path('img'), $filename);

        $user->update(['avatar' => $filename]);

        return back()->with('success', 'تم تحديث الصورة بنجاح');
    }

    // ============ Security Helper Methods ============

    /**
     * Get throttle key for rate limiting
     */
    protected function throttleKey(Request $request): string
    {
        $email = strtolower($request->input('email', ''));
        $ip = $request->ip();

        return 'admin_login|' . $ip . '|' . $email;
    }

    /**
     * Hit throttle (increment attempts)
     */
    protected function hitThrottle(Request $request): void
    {
        RateLimiter::hit(
            $this->throttleKey($request),
            $this->loginDecayMinutes * 60
        );
    }

    /**
     * Check if account is locked
     */
    protected function isAccountLocked(Request $request): bool
    {
        return RateLimiter::tooManyAttempts(
            $this->throttleKey($request),
            $this->maxLoginAttempts
        );
    }

    /**
     * Store session security data
     */
    protected function storeSessionSecurityData(Request $request, $user): void
    {
        $request->session()->put('admin_id', $user->id);
        $request->session()->put('admin_role', $user->role ?? 'employee');
        $request->session()->put('admin_login_time', now()->toIso8601String());
        $request->session()->put('admin_ip', $request->ip());
        $request->session()->put('admin_fingerprint', $this->generateFingerprint($request));
        $request->session()->put('admin_last_activity', now()->toIso8601String());

        // Store session ID in cache for concurrent session check
        Cache::put("admin_session_{$user->id}", session()->getId(), now()->addHours(8));
    }

    /**
     * Generate session fingerprint
     */
   protected function generateFingerprint(Request $request): string
{
    $userAgent = $request->userAgent() ?? '';
    $acceptLanguage = $request->header('Accept-Language') ?? '';
    $userId = Auth::guard('admin')->id() ?? '';

    return hash('sha256', $userAgent . $acceptLanguage . $userId . config('app.key'));
}

    /**
     * Log login attempt
     */
    protected function logLoginAttempt(Request $request, ?Employee $employee, string $status, ?string $failureReason = null): void
    {
        if (!config('admin.security.log_login_attempts', true)) {
            return;
        }

        try {
            AdminLoginLog::create([
                'employee_id' => $employee?->id,
                'email' => $request->email,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'login_at' => now(),
                'status' => $status,
                'failure_reason' => $failureReason,
            ]);

            // Log suspicious activity
            if ($status === 'failed' && config('admin.security.alert_on_suspicious_activity', true)) {
                $recentFailures = AdminLoginLog::where('ip_address', $request->ip())
                    ->where('login_at', '>=', now()->subHour())
                    ->failed()
                    ->count();

                if ($recentFailures >= config('admin.security.suspicious_activity_threshold', 5)) {
                    logger()->channel('security')->warning('Suspicious Login Activity', [
                        'ip' => $request->ip(),
                        'email' => $request->email,
                        'recent_failures' => $recentFailures,
                        'timestamp' => now()->toIso8601String(),
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Silently fail - don't break login flow
            logger()->error('Failed to log login attempt: ' . $e->getMessage());
        }
    }

    /**
     * Log logout
     */
    protected function logLogout(Employee $employee): void
    {
        try {
            // Update last login log
            $lastLog = AdminLoginLog::where('employee_id', $employee->id)
                ->where('status', 'success')
                ->latest('login_at')
                ->first();

            if ($lastLog) {
                $lastLog->update(['logout_at' => now()]);
            }
        } catch (\Exception $e) {
            logger()->error('Failed to log logout: ' . $e->getMessage());
        }
    }
}

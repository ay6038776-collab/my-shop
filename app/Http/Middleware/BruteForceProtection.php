<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class BruteForceProtection
{
    /**
     * Handle an incoming request
     */
    public function handle(Request $request, Closure $next, string $type = 'login'): Response
    {
        $identifier = $this->getIdentifier($request);
        $maxAttempts = $this->getMaxAttempts($type);
        $decayMinutes = $this->getDecayMinutes($type);

        // Check if IP is temporarily blocked
        if ($this->isIpBlocked($request)) {
            $remainingTime = $this->getRemainingBlockTime($request);
            
            return $this->tooManyAttemptsResponse($remainingTime);
        }

        // Check rate limiting using Laravel's built-in RateLimiter
        $key = $this->throttleKey($type, $identifier);
        
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $this->blockIp($request, $type, $decayMinutes * 2);
            
            $retryAfter = RateLimiter::availableIn($key);
            return $this->tooManyAttemptsResponse($retryAfter);
        }

        // Increment attempts
        RateLimiter::hit($key, $decayMinutes * 60);

        // Add rate limit headers
        $response = $next($request);

        $remaining = RateLimiter::remaining($key, $maxAttempts);
        $retryAfter = RateLimiter::availableIn($key);

        return $this->addRateLimitHeaders($response, $maxAttempts, $remaining, $retryAfter);
    }

    /**
     * Get identifier for rate limiting (IP + email/username)
     */
    protected function getIdentifier(Request $request): string
    {
        $ip = $request->ip();
        
        // For login attempts, also include email if present
        if ($request->has('email')) {
            return $ip . '|' . strtolower($request->input('email'));
        }

        return $ip;
    }

    /**
     * Get maximum attempts based on type
     */
    protected function getMaxAttempts(string $type): int
    {
        return match($type) {
            'login' => config('admin.security.login_max_attempts', 5),
            'password_reset' => config('admin.security.password_reset_max_attempts', 3),
            'api' => config('admin.security.api_max_attempts', 60),
            default => 10,
        };
    }

    /**
     * Get decay time in minutes based on type
     */
    protected function getDecayMinutes(string $type): int
    {
        return match($type) {
            'login' => config('admin.security.login_decay_minutes', 15),
            'password_reset' => config('admin.security.password_reset_decay_minutes', 30),
            'api' => config('admin.security.api_decay_minutes', 1),
            default => 1,
        };
    }

    /**
     * Generate throttle key
     */
    protected function throttleKey(string $type, string $identifier): string
    {
        return match($type) {
            'login' => 'admin_login|' . $identifier,
            'password_reset' => 'admin_password_reset|' . $identifier,
            'api' => 'admin_api|' . $identifier,
            default => 'admin|' . $type . '|' . $identifier,
        };
    }

    /**
     * Check if IP is temporarily blocked
     */
    protected function isIpBlocked(Request $request): bool
    {
        $ip = $request->ip();
        $cacheKey = "blocked_ip_{$ip}";

        return Cache::has($cacheKey);
    }

    /**
     * Get remaining block time in seconds
     */
    protected function getRemainingBlockTime(Request $request): int
    {
        $ip = $request->ip();
        $cacheKey = "blocked_ip_{$ip}";

        $blockedUntil = Cache::get($cacheKey);
        
        if (!$blockedUntil) {
            return 0;
        }

        return max(0, Carbon::parse($blockedUntil)->diffInSeconds(now()));
    }

    /**
     * Block IP temporarily
     */
    protected function blockIp(Request $request, string $type, int $durationMinutes): void
    {
        $ip = $request->ip();
        $cacheKey = "blocked_ip_{$ip}";
        $reasonKey = "block_reason_{$ip}";

        Cache::put($cacheKey, now()->addMinutes($durationMinutes), now()->addMinutes($durationMinutes));
        Cache::put($reasonKey, "Too many {$type} attempts", now()->addMinutes($durationMinutes));

        // Log the block
        logger()->channel('security')->warning("IP Blocked: {$ip}", [
            'type' => $type,
            'duration_minutes' => $durationMinutes,
            'blocked_until' => now()->addMinutes($durationMinutes)->toIso8601String(),
        ]);
    }

    /**
     * Return too many attempts response
     */
    protected function tooManyAttemptsResponse(int $retryAfter): Response
    {
        $message = 'Too many attempts. Please try again in ' . $this->formatSeconds($retryAfter) . '.';

        return response()->json([
            'message' => $message,
            'retry_after' => $retryAfter,
            'error_type' => 'rate_limited',
        ], 429)->withHeaders([
            'Retry-After' => $retryAfter,
            'X-RateLimit-Reset' => time() + $retryAfter,
        ]);
    }

    /**
     * Add rate limit headers to response
     */
    protected function addRateLimitHeaders(Response $response, int $maxAttempts, int $remaining, int $retryAfter): Response
    {
        $response->headers->set('X-RateLimit-Limit', $maxAttempts);
        $response->headers->set('X-RateLimit-Remaining', max(0, $remaining));
        $response->headers->set('X-RateLimit-Reset', time() + $retryAfter);

        return $response;
    }

    /**
     * Format seconds to human readable
     */
    protected function formatSeconds(int $seconds): string
    {
        if ($seconds < 60) {
            return "{$seconds} seconds";
        }

        $minutes = floor($seconds / 60);
        return "{$minutes} minute" . ($minutes > 1 ? 's' : '');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class InputSanitization
{
    /**
     * Handle an incoming request
     * Sanitizes input to prevent SQL injection and XSS
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only sanitize POST, PUT, PATCH requests
        if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $this->sanitizeInput($request);
            $this->validateInput($request);
        }

        return $next($request);
    }

    /**
     * Sanitize all input data
     */
    protected function sanitizeInput(Request $request): void
    {
        $input = $request->all();
        $sanitized = $this->recursiveSanitize($input);
        $request->merge($sanitized);
    }

    /**
     * Recursively sanitize input array
     */
    protected function recursiveSanitize(array $input): array
    {
        $sanitized = [];

        foreach ($input as $key => $value) {
            // Skip certain fields that should allow HTML (like rich text editors)
            if ($this->shouldSkipSanitization($key)) {
                $sanitized[$key] = $value;
                continue;
            }

            if (is_array($value)) {
                $sanitized[$key] = $this->recursiveSanitize($value);
            } elseif (is_string($value)) {
                $sanitized[$key] = $this->sanitizeString($value);
            } else {
                $sanitized[$key] = $value;
            }
        }

        return $sanitized;
    }

    /**
     * Sanitize a string value
     */
    protected function sanitizeString(string $value): string
    {
        // Remove null bytes
        $value = str_replace("\0", '', $value);

        // Trim whitespace
        $value = trim($value);

        // Remove potential SQL injection patterns
        $value = $this->removeSqlInjectionPatterns($value);

        // Remove potential XSS patterns (but keep safe HTML)
        $value = $this->removeXssPatterns($value);

        // Normalize line endings
        $value = str_replace(["\r\n", "\r"], "\n", $value);

        return $value;
    }

    /**
     * Remove SQL injection patterns
     */
    protected function removeSqlInjectionPatterns(string $value): string
    {
        $patterns = [
            '/\b(UNION|SELECT|INSERT|UPDATE|DELETE|DROP|CREATE|ALTER|EXEC|EXECUTE|XP_|SP_)\b/i',
            '/--/',                           // SQL comments
            '/\/\*.*?\*\//s',                // Block comments
            '/;\s*$/m',                       // Trailing semicolons
            '/\bOR\b.*=\b/i',                // OR 1=1 patterns
            '/\bAND\b.*=\b/i',               // AND 1=1 patterns
            '/\bINTO\s+(OUTFILE|DUMPFILE)\b/i',
            '/\bLOAD_FILE\b/i',
            '/\bBENCHMARK\b/i',
            '/\bSLEEP\b/i',
            '/\bIF\s*\(/i',
        ];

        foreach ($patterns as $pattern) {
            $value = preg_replace($pattern, '', $value);
        }

        return $value;
    }

    /**
     * Remove XSS patterns
     */
    protected function removeXssPatterns(string $value): string
    {
        // Use HTML entities for special characters
        $value = htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // Additional XSS pattern removal
        $xssPatterns = [
            '/<\s*script/i',
            '/javascript:/i',
            '/on\w+\s*=/i',                  // Event handlers
            '/<\s*iframe/i',
            '/<\s*object/i',
            '/<\s*embed/i',
            '/data:/i',                      // Data URLs
            '/vbscript:/i',
        ];

        foreach ($xssPatterns as $pattern) {
            $value = preg_replace($pattern, '', $value);
        }

        return $value;
    }

    /**
     * Check if field should skip sanitization
     */
    protected function shouldSkipSanitization(string $key): bool
    {
        $skipFields = [
            'password',
            'password_confirmation',
            '_token',
            '_method',
            // Cart fields
            'color',
            'quantity',
            'product_id',
            'customer_id',
            // Search fields
            'search',
            'query',
        ];

        return in_array($key, $skipFields);
    }

    /**
     * Validate input for suspicious patterns
     */
    protected function validateInput(Request $request): void
    {
        $suspiciousPatterns = $this->getSuspiciousPatterns();
        $input = $request->all();

        foreach ($input as $key => $value) {
            if (is_string($value) && $this->containsSuspiciousPattern($value, $suspiciousPatterns)) {
                $this->handleSuspiciousInput($request, $key, $value);
            }
        }
    }

    /**
     * Get list of suspicious patterns
     */
    protected function getSuspiciousPatterns(): array
    {
        return [
            '/<\s*script/i',
            '/javascript:/i',
            '/onerror\s*=/i',
            '/onload\s*=/i',
            '/onclick\s*=/i',
            '/\b(SELECT|UNION)\s+(ALL|DISTINCT)/i',
            "/'\s*(OR|AND)\s+'/i",
            '/\bUNION\s+(SELECT|ALL)/i',
            '/\bDROP\s+(TABLE|DATABASE)/i',
            '/\bEXEC\s*\(/i',
            '/\bXP_/i',
            '/\bINTO\s+DUMPFILE/i',
            '/file_get_contents/i',
            '/file_put_contents/i',
            '/base64_decode/i',
            '/eval\s*\(/i',
        ];
    }

    /**
     * Check if value contains suspicious pattern
     */
    protected function containsSuspiciousPattern(string $value, array $patterns): bool
    {
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $value)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Handle suspicious input
     */
    protected function handleSuspiciousInput(Request $request, string $key, string $value): void
    {
        // Log the suspicious input
        Log::channel('security')->warning('Suspicious Input Detected', [
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'field' => $key,
            'value_preview' => substr($value, 0, 100),
            'timestamp' => now()->toIso8601String(),
        ]);

        // For high severity patterns, block the request
        $highSeverityPatterns = [
            '/<\s*script/i',
            '/\bDROP\s+DATABASE\b/i',
            '/eval\s*\(/i',
        ];

      foreach ($highSeverityPatterns as $pattern) {
    if (preg_match($pattern, $value)) {
        if ($request->expectsJson()) {
            abort(403, 'Invalid input detected');
        }

        abort(403, 'تم اكتشاف إدخال غير صالح');
    }
}
    }
}

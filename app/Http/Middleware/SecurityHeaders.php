<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request
     * Adds security headers to all responses
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only add headers to HTML responses
        if ($this->shouldAddHeaders($response)) {
            $this->addSecurityHeaders($response, $request);
        }

        return $response;
    }

    /**
     * Determine if headers should be added
     */
    protected function shouldAddHeaders(Response $response): bool
    {
        $contentType = $response->headers->get('Content-Type', '');
        
        // Add headers to HTML and JSON responses
        return str_contains($contentType, 'text/html') 
            || str_contains($contentType, 'application/json')
            || $response->getStatusCode() >= 400;
    }

    /**
     * Add security headers to response
     */
    protected function addSecurityHeaders(Response $response, Request $request): void
    {
        // 1. X-Content-Type-Options - Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // 2. X-Frame-Options - Prevent clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // 3. X-XSS-Protection - XSS filter (legacy browsers)
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // 4. Referrer-Policy - Control referrer information
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // 5. Permissions-Policy - Control browser features
        $response->headers->set('Permissions-Policy', $this->getPermissionsPolicy());

        // 6. Strict-Transport-Security (HSTS) - Force HTTPS
        if ($request->isSecure()) {
            $hsts = 'max-age=31536000; includeSubDomains; preload';
            $response->headers->set('Strict-Transport-Security', $hsts);
        }

        // 7. Content-Security-Policy - Prevent XSS and injection attacks
        $response->headers->set('Content-Security-Policy', $this->getContentSecurityPolicy());

        // 8. Cache-Control for sensitive pages
        if ($this->isSensitiveRoute($request)) {
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');
        }

        // 9. Remove server signature
        $response->headers->remove('Server');
        $response->headers->remove('X-Powered-By');
    }

    /**
     * Get Permissions-Policy header value
     */
    protected function getPermissionsPolicy(): string
    {
        return implode(', ', [
            'accelerometer=()',
            'camera=()',
            'geolocation=()',
            'gyroscope=()',
            'magnetometer=()',
            'microphone=()',
            'payment=(self)',
            'usb=()',
        ]);
    }

    /**
     * Get Content-Security-Policy header value
     */
   protected function getContentSecurityPolicy(): string
{
    $policy = [
        "default-src 'self'",
        "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://cdn.tailwindcss.com https://code.jquery.com https://cdnjs.cloudflare.com",
       "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://cdn.tailwindcss.com",
        "img-src 'self' data: https: blob:",
        "font-src 'self' data: https://fonts.gstatic.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net",
        "connect-src 'self' https://cdn.jsdelivr.net",
        "media-src 'self' blob:",
        "object-src 'none'",
        "frame-src *",
        "frame-ancestors 'none'",
        "base-uri 'self'",
        "form-action 'self'",
        "upgrade-insecure-requests",
    ];

    return implode('; ', $policy);
}
    /**
     * Check if route is sensitive (admin, auth, etc.)
     */
    protected function isSensitiveRoute(Request $request): bool
    {
        $sensitivePatterns = [
            'admin/*',
            'login',
            'register',
            'password/*',
            'api/*',
        ];

        foreach ($sensitivePatterns as $pattern) {
            if ($request->is($pattern)) {
                return true;
            }
        }

        return false;
    }
}

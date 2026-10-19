<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use App\Http\Middleware\CustomerAuth;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\EnhancedAdminAuth;
use App\Http\Middleware\BruteForceProtection;
use App\Http\Middleware\SecurityHeaders;
use App\Http\Middleware\InputSanitization;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckPermission;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // Register middleware aliases
        $middleware->alias([
            // Authentication
            'customer.auth' => CustomerAuth::class,
            'admin.auth' => AdminAuth::class,
            'enhanced.admin.auth' => EnhancedAdminAuth::class,
            
            // Security
            'brute.force' => BruteForceProtection::class,
            'security.headers' => SecurityHeaders::class,
            'input.sanitize' => InputSanitization::class,
            
            // Utilities
            'set.locale' => SetLocale::class,
            'role' => CheckRole::class,
            'permission' => CheckPermission::class,
        ]);

        // Register global middleware
        $middleware->append([
            SecurityHeaders::class,
            InputSanitization::class,
        ]);

        // Admin middleware group with enhanced security
        $middleware->group('admin', [
            SecurityHeaders::class,
            InputSanitization::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            // Redirect to customer login for any customer-related routes
            if ($request->is('customer/*') || $request->is('profile') || $request->is('cart') || $request->is('checkout') || $request->is('orders') || $request->is('show/orders')) {
                return redirect()->route('customer.login')->with('error', 'يرجى تسجيل الدخول أولاً');
            }
            // Redirect admin routes to admin login
            if ($request->is('admin/*')) {
                return redirect()->route('login')->with('error', 'يرجى تسجيل الدخول أولاً');
            }
            return null;
        });
    })->create();

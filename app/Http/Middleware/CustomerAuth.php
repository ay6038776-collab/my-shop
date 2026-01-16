<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomerAuth
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.login')
                ->with('error', 'يرجى تسجيل الدخول أولاً');
        }

        return $next($request);
    }
}
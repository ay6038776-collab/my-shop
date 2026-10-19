<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Employee;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     * Usage: ->middleware('role:owner') or ->middleware('role:owner,supervisor')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        // Check if authenticated employee exists
        if (!$user || !($user instanceof Employee)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Check if user has any of the required roles
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        abort(403, 'ليس لديك صلاحية للوصول لهذه الصفحة');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Employee;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     * Usage: ->middleware('permission:manage-products')
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = $request->user();

        if (!$user || !($user instanceof Employee)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($user->hasPermission($permission)) {
            return $next($request);
        }

        abort(403, 'ليس لديك صلاحية لهذا الإجراء');
    }
}

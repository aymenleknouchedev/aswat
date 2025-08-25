<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleOrPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $type   // role أو permission
     * @param  string  $value
     */
    public function handle(Request $request, Closure $next, string $type, string $value)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        // تحقق من الدور
        if ($type === 'role' && $request->user()->hasRole($value)) {
            return $next($request);
        }

        // تحقق من الصلاحية
        if ($type === 'permission' && $request->$user->hasPermission($value)) {
            return $next($request);
        }

        // لو ما عندوش الدور ولا الصلاحية
        abort(403, 'Unauthorized');
    }
}

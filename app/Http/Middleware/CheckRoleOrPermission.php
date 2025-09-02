<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
    public function handle(Request $request, Closure $next, string $permission)
    {
        $user = $request->user();

        if (!$user || !$user->hasPermission($permission)) {
            return redirect()->route('dashboard.index')
                ->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}

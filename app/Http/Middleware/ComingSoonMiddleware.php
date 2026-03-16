<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComingSoonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $comingSoon = filter_var(env('COMING_SOON', false), FILTER_VALIDATE_BOOLEAN);

        if ($comingSoon) {
            if ($request->is('dashboard/auth') || $request->is('dashboard/login')) {
                return $next($request);
            }

            if (Auth::check()) {
                return $next($request);
            }

            if (!$request->is('/')) {
                return redirect('/');
            }
            return response()->view('coming-soon');
        } else {
            return $next($request);
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('speakers')->check()) {
            return redirect()->route('talk-proposals');
        }

        if (Auth::guard('web')->check()) {
            return redirect()->route('reviewer-dashboard');
        }

        return $next($request);
    }
}

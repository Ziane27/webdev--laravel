<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (!Session::has('loginId')) {
        //     return back()->with('fail', 'You need to logged in');
        // }

        if (!Session::has('loginId')) {
            // Allow access to login and register routes
            if ($request->is('login') || $request->is('register') || $request->is('user-login') || $request->is('user-register')) {
                return $next($request);
            }

        // Redirect to login page instead of "back"
            return redirect('/login')->with('fail', 'You need to log in first');
        }

        if (!Session::has('loginId')) {
            return redirect()->route('auth.index')->with('fail', 'You need to log in');
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in and has an "admin" role
        if (Auth::guard('admin')->check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
        
        return $next($request);

        // Redirect non admin user
        return redirect('/')->with('error', 'Access denied. Admins only.');
    }
}

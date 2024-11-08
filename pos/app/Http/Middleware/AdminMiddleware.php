<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->role !== 'admin') {
                // Redirect non-admin users to a specific page, not back to login
                return redirect('/'); // Or any other page you'd like non-admin users to go
            }
        } else {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        return $next($request);
    }


}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Not logged in
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Logged in but not an admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('student.dashboard')
                ->with('error', 'You are not authorized to access the admin panel.');
        }

        return $next($request);
    }
}
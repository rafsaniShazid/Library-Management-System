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
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!$request->user()) {
            abort(403, 'Unauthorized action. Please login first.');
        }
        
        // Check if user is an admin
        if ($request->user()->role !== 'admin') {
            abort(403, 'Unauthorized action. Admin access required.');
        }
        
        return $next($request);
    }
}

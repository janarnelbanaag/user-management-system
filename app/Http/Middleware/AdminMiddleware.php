<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $user = $request->user();

        // Check if user is authenticated and has 'admin' role
        if (!$user || $user->role !== 'admin') {
            if ($request->expectsJson() || $request->is('api/*') || $request->wantsJson()) {
                throw new AuthenticationException("Unauthorized. Admins only.");
            }

            return Inertia::render('Dashboard', [
                'errorMessage' => 'User Account. Not enough privilege.'
            ]);
        }
        
        return $next($request);
    }
}

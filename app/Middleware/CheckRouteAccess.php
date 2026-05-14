<?php

namespace App\Middleware;
//namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRouteAccess
{
   public function handle($request, Closure $next)
{
    $user = Auth::user();
    
    // Debug: Check what $user->role actually contains
    if ($user) {
        \Log::info('=== DEBUG ROLE ACCESS ===');
        \Log::info('User ID: ' . $user->id);
        \Log::info('User role_id value: ' . $user->role_id);
        \Log::info('Type of $user->role: ' . gettype($user->role));
        \Log::info('Value of $user->role: ' . print_r($user->role, true));
        
        // Check if role is a string or object
        if (is_string($user->role)) {
            \Log::warning('$user->role is a string: ' . $user->role);
        } elseif (is_object($user->role)) {
            \Log::info('$user->role is an object of type: ' . get_class($user->role));
        } else {
            \Log::warning('$user->role is: ' . gettype($user->role));
        }
    }

    // Safely get current route name
    $currentRoute = $request->route() ? $request->route()->getName() : null;

    // If route has no name, skip check
    if (!$currentRoute) {
        return $next($request);
    }

    // Skip middleware for auth routes
    $authRoutes = ['login', 'logout', 'register', 'password.request', 'password.reset'];
    if (in_array($currentRoute, $authRoutes)) {
        return $next($request);
    }

    // If user not logged in, redirect to login
    if (!$user) {
        return redirect('/login');
    }

    // Check if user has access to this route
    // Make sure your User model has the relationship with role and routes
    $allowedRoutes = $user->role->routes->pluck('route_name')->toArray();

    if (!in_array($currentRoute, $allowedRoutes)) {
        abort(403, 'You do not have permission to access this route.');
    }

    return $next($request);
}
}

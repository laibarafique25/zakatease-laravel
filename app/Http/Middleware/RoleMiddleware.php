<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this area.');
        }

        $user = auth()->user();

        // Deactivated user check (must come before role check)
        if (!$user->isActive()) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Your account has been deactivated. Please contact support.');
        }

        // If the user's role is in the list of allowed roles, grant access
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Redirect to the correct panel if role doesn't match the route
        if (in_array($user->role, ['super_admin', 'admin'])) {
            return redirect('/admin');
        } elseif ($user->role === 'organization') {
            return redirect('/organization/dashboard');
        } else {
            return redirect('/dashboard');
        }
    }
}

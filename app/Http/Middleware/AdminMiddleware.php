<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;




class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in and is an Admin
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        // If not admin, redirect to home page with error
        return redirect('/')->with('error', 'Unauthorized access.');
    }
}

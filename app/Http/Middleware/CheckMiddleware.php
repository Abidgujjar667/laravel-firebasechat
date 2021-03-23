<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()){
            return redirect('/login');
        }
        // User role
        $role = Auth::user()->roles->first()->name;
        // Check user role
        if ($role=='admin'){
            return $next($request);
        }

        return redirect('/error404');

    }
}

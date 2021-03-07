<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd($next($request));
        if (!Auth::check()) {
            return redirect('login');
        }
        if (Auth::user()->role =='admin') {
            return $next($request);
        }
        return back()->withErrors("you have no permission");
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Access
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

        if (!Auth::check()) {
            return redirect(route('login'));
        }
        // dd($request->suite_id);
        $suiteId = $request->route()->parameter('suiteId') ?? $request->route()->parameter('suite')->id ??
        $request->route()->parameter('slide')->suite_id ??
        $request->route()->parameter('product')->suite_id ??
        $request->route()->parameter('marquee')->suite_id ??
        $request->route()->parameter('article')->suite_id ??
        $request->suite_id ?? null;
        // dd(Auth::user()->role =='admin'||Auth::user()->suite->id==$suiteId);
        if (Auth::user()->role == 'admin' || Auth::user()->suite->id == $suiteId) {
            return $next($request);
        }
        return back()->withErrors('you have no access');
    }
}

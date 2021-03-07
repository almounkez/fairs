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

        if(!Auth::check()){
            return redirect(route('login'));
        }

        $suiteId=$request->route()->parameter('suiteId')??$request->route()->parameter('suite')->id??null;
        // dd(  $suiteId,Auth::user()->suite->id);
        if(Auth::user()->role =='admin'||Auth::user()->suite->id==$suiteId)
            return $next($request);
        else
            return back()->withErrors('you have no permission');
    }
}

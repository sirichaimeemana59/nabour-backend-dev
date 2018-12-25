<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
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
        //return redirect('/sales/contract/list');
        //dd(Auth::user());
        //dd(Auth::guest());
        if( Auth::check() && Auth::user()->role !== 0 ) {
            return redirect('/');
        }
        return $next($request);
    }
}

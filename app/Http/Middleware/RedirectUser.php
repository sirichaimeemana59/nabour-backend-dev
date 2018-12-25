<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectUser
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
        if( Auth::check() || Auth::viaRemember()) {
            if( Auth::user()->role == 0)
                return redirect ('customer/customer/list');
            else if( Auth::user()->role == 1 )
                return redirect ('customer/customer/list');
            else if( Auth::user()->role == 2 )
                return redirect ('sales/quotation/list');
            else
                return redirect ('auth/logout')->send();
        } else return $next($request);
    }
}

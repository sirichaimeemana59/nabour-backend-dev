<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            $role = Auth::user()->role;

            switch ($role) {
                case '0':
                    $ru = 'customer/customer/list';
                    break;
                case '1':
                    $ru =  '/projects';
                    break;
                default:
                    $ru =  '/home';
                    break;
            }
            return redirect($ru);
        }
        return $next($request);
    }
}

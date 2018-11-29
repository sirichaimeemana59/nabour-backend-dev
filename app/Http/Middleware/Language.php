<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Application;

class Language {

    protected $auth;
    protected $app;

    public function __construct(Application $app, Guard $auth) {
        $this->app = $app;
        $this->auth = $auth;
    }

   
    public function handle($request, Closure $next)
    {
        if($this->auth->guest()) {
            if( $request->get('lang') ){
                session()->put('lang', $request->get('lang'));
            } elseif ( !session()->get('lang') ) {
                session()->put('lang', $this->app->getLocale());
            }         
        }
        else {
            if(session()->get('lang') != $this->auth->user()->lang )
                session()->put('lang', $this->auth->user()->lang);
        }
        $this->app->setLocale(session()->get('lang'));
        return $next($request);
    }

}
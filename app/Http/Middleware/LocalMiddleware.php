<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LocalMiddleware
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
        $lang=null;

        if(Auth::check() && !Session::has('locale'))
        {
           $lang=$request->user()->lang;
           Session::put('locale',$lang);
        }
        if($request->has('lang'))
        {
            $lang = $request->get('lang');
            Session::put('locale', $lang);

        }

         $lang=Session::get('locale');

        if($lang==null)
        {
            $lang=config('app.fallback_locale');
        }
        
        App::setLocale($lang);
        return $next($request);
    }
}

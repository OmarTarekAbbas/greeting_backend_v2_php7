<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class FrontLogin
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
        if (Session::has('phone_number')&&  Session::get('phone_number') != ''  &&  Session::get('status') == 'active') {
            // dd('a');
        }else{
            // dd(Session::get('status'));
            return redirect('/');
        }

        return $next($request);
    }
}

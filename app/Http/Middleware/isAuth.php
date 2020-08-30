<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isAuth
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
        if(Auth::user() && Auth::user()->isAdministrator()) {

            return $next($request);

        }
        else {

            return redirect('/');
            
        }
    }
}


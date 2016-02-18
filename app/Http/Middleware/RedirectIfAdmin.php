<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectIfAdmin
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
            //check the user if it's admin
        if(Auth::user()->userGroup->name = 'admin'){
            return $next($request);
        } else {
            return redirect('/user');
        }

    }
}

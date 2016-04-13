<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectIfUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //check the user if it's admin
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->userGroup->name == 'user') {
                if (preg_match_all('/^user/', $request->path())) {
                    return $next($request);
                }

                return redirect('/users');
            } else {
                return redirect('/users');
            }
        } else {
            return redirect()->to('/login');
        }
    }
}

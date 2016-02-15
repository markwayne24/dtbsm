<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use app\Models\User;

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
/*            $users = User::with('userGroup')->get();
            if ($users->userGroup->name == 'admin'){*/
                return redirect('/admin/dashboard');
/*            }else{
                return redirect('');
            }*/

        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;

class RedirectIfVerified
{
    protected $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/login');
            }
        }

        if (\Session::has('verified') && \Session::get('verified') == true) {
                return $next($request);
            }

            if ($request->path() == 'login/verify') {
                return $next($request);
            }

            return redirect()->to('/login/verify');
    }


}

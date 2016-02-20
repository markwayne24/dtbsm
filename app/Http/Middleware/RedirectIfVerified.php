<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\SessionManager;

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
    public function handle($request, Closure $next)
    {
        if (\Session::has('verified') && \Session::get('verified') == true) {
            return $next($request);
        }

        return redirect()->to('/login');
    }
}

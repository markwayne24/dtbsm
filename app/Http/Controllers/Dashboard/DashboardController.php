<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Session\SessionManager;

class DashboardController extends Controller
{
    protected $session;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('userGroup')->get();
        return view('admin.dashboard')->with('users', $users);
    }
}

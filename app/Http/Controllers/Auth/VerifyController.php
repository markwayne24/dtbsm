<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\MessageBag;
use Illuminate\Session\SessionInterface;
use Illuminate\Session\SessionManager;

class VerifyController extends Controller
{

    protected $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function index()
    {
        return view('auth.verify');
    }

    public function verify(Request $request)
    {
        $verificationCode = '1234';
        $this->validate($request,[
            'code'=>'required'
        ]);

        $code = $request->all();

        if ($code['code'] == $verificationCode) {
            // Security code passed...

            $this->session->set('verified', true);

            return redirect()->intended('/admin/dashboard');
        } else{
            $this->session->set('verified', false);

            $errors = new MessageBag(['code' => ['Incorrect code!']]);
            return redirect()->back()->withErrors($errors)->withInput();

        }



    }
}

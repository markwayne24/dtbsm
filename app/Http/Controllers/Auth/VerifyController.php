<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class VerifyController extends Controller
{


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
            return redirect()->intended('/admin/dashboard');
        } else{

            $message = [
                "error" => [
                    "code" => 401,
                    "message" => "Invalid code"
                ]
            ];

            return redirect()->back()->withErrors($message)->withInput();

        }



    }
}

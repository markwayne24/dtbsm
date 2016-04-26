<?php

namespace App\Http\Controllers\Auth;

use App\Aindong\SMS\Chikka;
use App\Models\VerficationCode;
use Carbon\Carbon;
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

    public function index()
    {
        $userId = \Auth::user()->id;

        $rawCode = $this->thereIsAPendingCodeForUser($userId);
        if ($rawCode) {
            $verificationCode = str_pad($rawCode['code'], 4, '0', STR_PAD_LEFT);
            \Session::set('verification', $verificationCode);
        } else {
            $rawCode = $this->createAVerificationCodeForUser($userId);
            $verificationCode = str_pad($rawCode['code'], 4, '0', STR_PAD_LEFT);
            \Session::set('verification', $verificationCode);
        }

        $number = \Auth::user()->userProfile->contact_number;
        $this->sendSMS($number, $verificationCode);

        return view('auth.verify');
    }

    public function verify(Request $request)
    {
        $verificationCode = '1234';
        $this->validate($request,[
            'code'=>'required'
        ]);

        $code = $request->all();

        if (\Session::has('verification')) {
            $verificationCode = \Session::get('verification');
        }

        if ($code['code'] == $verificationCode) {

            $this->updateCodeToComplete(\Auth::user()->id);

            // Security code passed...

            \Session::set('verified', true);
             //('verified', true);
            if(Auth::user()->userGroup->name == 'admin'){
                return redirect()->intended('/admin/dashboard');
            } else{
                return redirect()->intended('/users');
            }

        } else{
            \Session::set('verified', false);

            $errors = new MessageBag(['code' => ['Incorrect code!']]);
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }

    private function updateCodeToComplete($userId)
    {
        $code = VerficationCode::where('user_id', $userId)->update(['status' => 'completed']);

        return $code;
    }

    private function sendSMS($number, $code)
    {
        $chikka = new Chikka();

        $option = [
            'message_type'  => 'SEND',
            'mobile_number' => $number,
            'message'       => 'Your verification code is: '.$code
        ];

        $chikka->setOptions($option)
            ->sendNotification();
    }


    private function thereIsAPendingCodeForUser($userId)
    {
        $code = VerficationCode::where('user_id', $userId)
            ->where('status', 'pending')
            ->whereDate('code_date', '=', Carbon::today('Asia/Manila')->toDateString())
            ->first();

        if ($code) {
            return $code;
        }

        return false;
    }

    private function createAVerificationCodeForUser($userId)
    {
        $data = [
            'user_id'   => $userId,
            'status'    => 'pending',
            'code_date' => Carbon::today('Asia/Manila')->toDateString(),
            'code'      => $this->generateNewUniqueCode($userId)
        ];

        $code = VerficationCode::create($data);
        
        return $code;
    }

    private function generateNewUniqueCode($userId)
    {
        $lastCode = $this->getLastCodeToday();

        return $lastCode + 1;
    }

    private function getLastCodeToday()
    {
        $code = VerficationCode::whereDate('code_date', '=', Carbon::today('Asia/Manila')->toDateString())
            ->orderBy('code', 'DESC')
            ->first();


        return $code ? $code['code'] : 0;
    }
}

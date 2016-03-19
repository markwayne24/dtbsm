<?php

namespace App\Http\Controllers\User\Profile;

use App\Models\UserProfile;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Session\SessionManager;

class ProfileController extends Controller
{
    protected $session;

    public function __contstruct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function index()
    {
        return view('users.profile.index');
    }

    public function edit($users)
    {
        $user = User::findorFail($users);
        $user->userProfile->get();

        return response()->json($user);
    }

    public function update(Request $request,$users)
    {
        $input = $request->all();

        $user = UserProfile::where('user_id', $users)->update($input);

        return response()->json($user);
    }

    public function destroy($users)
    {
        $user = User::find($users)->delete();

        return response()->json($user);
    }

}

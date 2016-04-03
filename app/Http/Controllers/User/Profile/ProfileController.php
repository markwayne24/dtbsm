<?php

namespace App\Http\Controllers\User\Profile;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

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

    public function update(UserRequest $request,$users)
    {
        $input = $request->all();
        $userData = [
            'email' => $input['email'],
            'password'=> Hash::make($input['password']),
        ];
        $profileData = [
            'firstname'=>  $input['firstname'],
            'middlename'=> $input['middlename'],
            'lastname' => $input['lastname'],
            'address' => $input['address'],
            'gender'=>$input['gender'],
            'contact_number'=>$input['contact_number'],
        ];

       $user = User::where('id', $users)->update($userData);
        $user = UserProfile::where('user_id',$users)->update($profileData);

       /* //image
        $image = $request->file('image');
        $imageTempName = $image->getPathname();
        $imageName = $image->getClientOriginalName();
        $path = base_path() . '/public/uploads/images/';
        $request->file('image')->move($path , $imageName);
        UserProfile::table('consultants')
            ->where('image', $imageTempName)
            ->update(['image' => $imageName]);*/

        return response()->json($user);
    }

    public function destroy($users)
    {
        $user = User::find($users)->delete();

        return response()->json($user);
    }

}

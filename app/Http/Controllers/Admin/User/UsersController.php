<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Support\Facades\Hash;
use App\Models\UserGroup;
use App\Models\UserProfile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\MessageBag;
use App\Models\User;
use Illuminate\Session\SessionManager;
use Illuminate\Session;

class UsersController extends Controller
{

    protected $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function index()
    {
        $users = User::with('userProfile','userGroup')->get();
        $usertypes = UserGroup::all();

        return view('admin.users.index')->with('users', $users)
            ->with('usertypes',$usertypes);
    }

    public function store(StoreUserRequest $request)
    {
        $input = $request->all();
        //save credentials
        $user = User::create($input);
        $user->password = Hash::make($request->input([('password')]));
        $user->save();
        $user->userProfile()->create($input);
        $profileData = [
            'district'=>$input['district']
        ];
        $user->userProfile()->update($profileData);
        \Session::flash('flash_message','Successfully saved.');

        return response()->json($user);

    }

    public function  edit($users)
    {
        $user = User::findOrFail($users);
        $user->userProfile->get();
        $user->userGroup->get();

        return response()->json($user);
    }

    public function update(StoreUserRequest $request, $users)
    {
        $input = $request->all();

        $userData = [
            'group_id'=> $input['group_id'],
            'email' => $input['email'],
            'password'=> Hash::make($input['password']),
        ];

        $profileData = [
            'firstname' => $input['firstname'],
            'middlename'=> $input['middlename'],
            'lastname'  => $input['lastname'],
            'address'   =>  $input['address'],
            'district'  => $input['district'],
            'school'    =>  $input['school'],
            'gender'    =>  $input['gender'],
            'contact_number' => $input['contact_number'],
        ];

        $user = User::where('id', $users)->update($userData);
        $user = UserProfile::where('user_id',$users)->update($profileData);
        //$user->userProfile()->update($profileData);

        \Session::flash('flash_message','Successfully updated.');

        return response()->json($user);
    }

    public function destroy($users)
    {
        $user = User::destroy($users);
        // Delete user's profile from database.
        UserProfile::where('user_id',$users)->delete();

        return response()->json($user);
    }

}

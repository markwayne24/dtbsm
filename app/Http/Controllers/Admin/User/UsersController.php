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

        return view('admin.users.index')->with('users', $users)->with('usertypes',$usertypes);
    }

    public function store(StoreUserRequest $request)
    {
        //get the id of the userGroup
        $id = $request->only('group_id');
        $id = UserGroup::where('name',$id)->first();
        $type = $id->id;
        //save creadentials
        $user = User::create($request->all());
        $user->group_id = $type;
        $user->password = Hash::make($request->input([('password')]));
        $user->save();

        //saving profile
        $user->userProfile()->create($request->all());

        //Session::success('message', 'Successfully created user');

        \Session::flash('flash_message','Successfully created Users.');
        return redirect()->back()->with('message',flash_message);

    }

    public function  edit($users)
    {
        $user = User::findOrFail($users);
        \Response::json($user);
    }

    public function update(StoreUserRequest $request, $userId)
    {
        $input = $request->all();

        $user = User::where('id', $userId)->update($input);

        return view('admin/dashboard/users');
    }

    public function destroy($userId)
    {
        $user = User::find($userId)->delete();
        // Delete user's profile from database.
        $user->userProfile->delete();

        return view('admin/dashboard/users');
    }

}

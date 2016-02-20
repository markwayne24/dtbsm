<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Hash;
use App\Models\UserGroup;
use App\Models\UserProfile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
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
        $users = User::with('userProfile','userGroup')->paginate(15);
        $usertypes = UserGroup::all();

        return view('admin.users.index')->with('users', $users)->with('usertypes',$usertypes);
    }

    public function store(StoreUserRequest $request)
    {
        $id = $request->only('group_id');
        $id = UserGroup::where('name',$id)->first();
        $type = $id->id;
        $user = User::create($request->all());
        $user->group_id = $type;
        $user->password = Hash::make($request->input([('password')]));
        $user->remember_token = $request->input(['_token']);
        $user->save();
        $user->userProfile()->create($request->all());
        //Session::success('message', 'Successfully created user');
        return redirect()->back();

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

        if (! $user) {
            return 'User Id not found';
        }

        return view('admin/dashboard/users');
    }

}

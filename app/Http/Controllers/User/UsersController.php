<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Session\SessionManager;

class UsersController extends Controller
{

    protected $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;

    }

    public function index()
    {

        $users = User::paginate(5);
        return view('admin.register')->with('users', $users);
    }

    public function store(StoreUserRequest $request)
    {
        $input = $request->all();
        $input['group_id']= 'user';

        $user = User::create($input);

        return view('admin/dashboard/users');
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

<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class UsersController extends Controller
{

    public function index()
    {

        $users = User::paginate(10);
        return view('admin.register')->with('users', $users);
    }

    public function store(StoreUserRequest $request)
    {
        $input = $request->all();

        $user = User::create($input);

        return $user;
    }

    public function update(StoreUserRequest $request, $userId)
    {
        $input = $request->all();

        $user = User::where('id', $userId)->update($input);

        return $user;
    }

    public function destroy($userId)
    {
        $user = User::find($userId)->delete();

        if (! $user) {
            return 'User Id not found';
        }

        return $user;
    }

}

<?php

namespace App\Http\Controllers\User\Profile;

use App\Models\UserProfile;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Input;

use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
 /*       $file = $request->file('image_path');

            $extension = $file->getClientOriginalExtension();

            $filename = $request->only('firstname') . '-' . $users . '.jpg';

            if($file) {
                Storage::disk('local')->put($filename, File::get($file));
            }

        print_r($file);exit();

            return redirect()->route('users');*/



      $input = $request->all();
                $userData = [
                    'email' => $input['email'],
                    'password'=> Hash::make($input['password']),
                ];

               $user = User::where('id', $users)->update($userData);
                $imageName = $users . '.' .
                    $request->file('image_path')->getClientOriginalName();

                $request->file('image_path')->move(
                    base_path() . '/public/uploads/images/', $imageName
                );


                $profileData = [
                    'firstname'=>  $input['firstname'],
                    'middlename'=> $input['middlename'],
                    'lastname' => $input['lastname'],
                    'address' => $input['address'],
                    'school' => $input['school'],
                    'gender'=>$input['gender'],
                    'contact_number'=>$input['contact_number'],
                ];
                $user = UserProfile::where('user_id',$users)->update($profileData);
                $user->image = $imageName;

                $photo = null;
                $file= Input::file('image_path');
                if(Input::hasFile('image_path')){

                    $extension = $file->getClientOriginalExtension();
                    $name = $file->getClientOriginalName();
                    $photo	= public_path().'/'.$name . Auth::user()->id .$extension;
                    $file->move(public_path(),$name);
                }else{$photo='no image';}

                print_r($file); exit();

                $dataStore = [
                    'image_path'=> $photo
                ];
        UserProfile::where('user_id', $users)->update($dataStore);



        return response()->json($dataStore);

        /*
                public function upload() {
                if(Input::hasFile('file')) {
                    //upload an image to the /img/tmp directory and return the filepath.
                    $file = Input::file('file');
                    $tmpFilePath = '/img/tmp/';
                    $tmpFileName = time() . '-' . $file->getClientOriginalName();
                    $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
                    $path = $tmpFilePath . $tmpFileName;
                    return response()->json(array('path'=> $path), 200);
                } else {
                    return response()->json(false, 200);
                }
            }*/

        /*        if(Input::hasFile('file')) {
                    //upload an image to the /img/tmp directory and return the filepath.
                    $file = Input::file('image_path');
                    $tmpFilePath = '/img/tmp/';
                    $tmpFileName = time() . '-' . $file->getClientOriginalName();
                    $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
                    $path = $tmpFilePath . $tmpFileName;
                    $imageName = UserProfile::where('user_id',Auth()->user()->id)
                        ->update('image_path',$path);
                    return response()->json(array('path'=> $path), 200);
                } else {
                    return response()->json(false, 200);
                }*/
    }

    public function getUserImage($filename){
        $file = Storage::disk('local')->get($filename);
        return new \Response($file, 200);
    }

    public function destroy($users)
    {
        $user = User::find($users)->delete();

        return response()->json($user);
    }



}

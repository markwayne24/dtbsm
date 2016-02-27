<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'group_id'=>'required',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
                'firstname' => 'required|min:2',
                'middlename' => 'required',
                'lastname' => 'required',
                'address' => 'required|min:5',
                'gender' => 'required',
                'contact_number' => 'required|numeric|unique:user_profiles,contact_number',
        ];
    }
}

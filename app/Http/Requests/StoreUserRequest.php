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
                'email' => 'required|email|max:56|unique:users,email,' .$this->getSegmentFromEnd().',id',
                'password' => 'required',
                'firstname' => 'required|string|min:2|max:56',
                'middlename' => 'required|string|min:1|max:56',
                'lastname' => 'required|string|min:2|max:56',
                'address' => 'required|min:5',
                'gender' => 'required',
                'contact_number' => [ 'regex:/^(09|9)\d{9}$/' ],
                /*'required|numeric|unique:user_profiles,contact_number'*/
        ];
    }

    private function getSegmentFromEnd($position_from_end = 1) {
        $segments =$this->segments();
        return $segments[sizeof($segments) - $position_from_end];
    }
}

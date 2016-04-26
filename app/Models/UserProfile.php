<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class UserProfile extends Model
{
    protected $table = 'user_profiles';

    protected $guarded = ['id'];

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'address',
        'school',
        'gender',
        'contact_number',
        'image_path'
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function insertPhoto($fileName,$path,$defaultName = null){
        $photo = null;
        $file= Input::file($fileName);
        if(Input::hasFile($fileName)){
            $destinationPath = $path;
            $extension = $file -> getClientOriginalExtension;
            $name = $file->getClientOriginalName();
            $name =date('Y-m-d').Time().rand(11111,99999).'.'.$extension;
            $photo	=$destinationPath.'/'.$name;
            $file->move($destinationPath,$name);}else{$photo=$defaultName;}
        return $photo;
    }

}

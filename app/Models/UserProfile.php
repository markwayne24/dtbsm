<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profile';

    protected $guarded = ['user_id'];

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'address',
        'gender',
        'contact_number'
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}

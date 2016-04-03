<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';

    protected $guarded = ['id'];

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'address',
        'gender',
        'contact_number',
        'image'
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}

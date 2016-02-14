<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id'];

    protected $fillable = [
        'group_id',
        'firstname',
        'middlename',
        'lastname',
        'email',
        'password',
        'address',
        'gender',
        'mobilenum'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userGroup()
    {
        return $this->belongsTo('App\Models\UserGroup','group_id');
    }
}

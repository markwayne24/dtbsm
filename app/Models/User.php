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

/*    protected $guarded = ['id'];*/

    protected $fillable = [
        'group_id',
        'email',
        'password',
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

    public function userProfile()
    {
        return $this->hasOne('App\Models\UserProfile');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Items');
    }

    public function userRequest(){
        return $this->hasMany('App\Models\Requests');
    }

    public function budgetHistory()
    {
        return $this->hasMany('App\Models\BudgetHistory');
    }
}
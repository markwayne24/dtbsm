<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table = 'user_groups';

    protected $guarded = ['id'];

    protected $fillable = [
        'name'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}

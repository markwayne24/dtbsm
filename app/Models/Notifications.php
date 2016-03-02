<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notifications';

    protected $guarded = ['id'];

    protected $fillable = [
        'message',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}

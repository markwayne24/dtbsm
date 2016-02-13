<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    protected $table = 'notif';

    protected $guarded = ['id','user_id'];

    protected $fillable = [
        'description',
        'message'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}

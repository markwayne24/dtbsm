<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $table = 'requests';

    protected $fillable = ['user_id','approved_at', 'created_at'];

    protected $dates = ['approved_at'];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function itemRequests(){
        return $this->hasMany('App\Models\ItemRequests');
    }


}

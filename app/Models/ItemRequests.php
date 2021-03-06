<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemRequests extends Model
{
    protected $table = 'inventory_requests';

    protected $fillable =[
        'request_id',
        'inventory_id',
        'status',
        'quantity',
        'price',
        'reason'
    ];

    public function requests(){
        return $this->belongsTo('App\Models\Requests','request_id');
    }

    public function inventory(){
        return $this->belongsTo('App\Models\Inventory','inventory_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';

    protected $guarded = ['id'];
    protected  $fillable = [
        'item_id',
        'sku',
        'price',
        'stocks'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function items(){
        return $this->belongsTo('App\Models\Items', 'item_id');
    }


}

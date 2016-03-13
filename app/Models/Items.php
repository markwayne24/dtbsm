<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';

    protected $fillable = [
        'name',
        'item_type_id'
    ];

    protected $hidden = ['created_at', 'updated_at'];


    public function itemTypes()
    {
        return $this->belongsTo('App\Models\ItemType', 'item_type_id');
    }

    public function inventory(){
        return $this->belongsTo('App\Models\Inventory');
    }
}

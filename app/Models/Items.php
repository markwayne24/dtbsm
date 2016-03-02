<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';

    protected $guarded = ['item_type_id'];

    protected $fillable = [
        'name'
    ];

    protected $hidden = ['created_at', 'updated_at'];


    public function itemTypes()
    {
        return $this->belongsTo('App\Models\ItemType', 'item_type_id');
    }
}

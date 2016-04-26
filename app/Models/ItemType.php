<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    protected $table = 'item_type';

    protected $guarded = ['id'];

    protected $fillable = [
        'categories',
        'name'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function items(){
        return $this->hasMany('App\Models\Items');
    }
}

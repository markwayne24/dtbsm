<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $table ='budget';
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable =[
        'amount'
    ];

    public function inventory()
    {
        return $this->belongsToMany('App\Models\Inventory');
    }
}

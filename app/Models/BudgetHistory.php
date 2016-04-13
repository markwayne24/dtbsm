<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetHistory extends Model
{
    protected $table ='budget_histories';
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable =[
        'user_id',
        'item_id',
        'action',
        'amount',
        'budget_year'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function items()
    {
       return $this->belongsTo('App\Models\Items','item_id');
    }

}

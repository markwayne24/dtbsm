<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerficationCode extends Model
{
    protected $table = 'verification_codes';
    protected $fillable = ['status', 'user_id', 'code', 'code_date'];
}

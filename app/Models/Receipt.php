<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'number','date','payer_name','payer_email','amount','mode','reference','notes'
    ];
}

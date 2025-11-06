<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'number','date','payee_name','amount','mode','reference','notes'
    ];
}

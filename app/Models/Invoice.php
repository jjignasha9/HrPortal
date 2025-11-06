<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'number','date','client_name','client_email','client_phone','client_address','subtotal','tax','total','items'
    ];

    protected $casts = [
        'date' => 'date',
        'items' => 'array',
    ];
}

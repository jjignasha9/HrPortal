<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'code','title','description','priority','status','created_by','assigned_to'
    ];
}

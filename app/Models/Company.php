<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'code','name','email','phone','website','address','city','country','logo_path'
    ];
}

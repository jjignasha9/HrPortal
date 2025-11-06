<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'code','name','company_id','start_date','end_date','status','budget','description'
    ];
}

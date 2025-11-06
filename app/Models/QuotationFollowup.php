<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationFollowup extends Model
{
    protected $fillable = [
        'quotation_id','follow_up_date','status','notes','user_id'
    ];
}



<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquiryFollowup extends Model
{
    protected $fillable = [
        'inquiry_id','follow_up_date','status','notes','user_id'
    ];
}



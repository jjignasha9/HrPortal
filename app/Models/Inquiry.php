<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'code','name','email','phone','source','message','status'
    ];

    public function followups()
    {
        return $this->hasMany(\App\Models\InquiryFollowup::class);
    }
}

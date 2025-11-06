<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'code','type','client_name','client_email','amount','status','notes'
    ];

    public function followups()
    {
        return $this->hasMany(\App\Models\QuotationFollowup::class);
    }
}

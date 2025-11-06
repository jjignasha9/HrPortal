<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id','serial_no','unique_no','salary_month','format_type','payment_date','payment_amount'
    ];
}



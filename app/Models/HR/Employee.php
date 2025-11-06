<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'code','first_name','last_name','email','mobile','dob','gender','photo_path',
        'designation','department','joining_date','salary','manager_id','user_id'
    ];
}

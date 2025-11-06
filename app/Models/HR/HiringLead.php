<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

class HiringLead extends Model
{
    protected $fillable = [
        'code',
        'name',
        'mobile',
        'address',
        'position',
        'experience_years',
        'expected_salary',
        'gender',
        'has_experience',
        'previous_company',
        'resume_path',
        'created_by',
    ];
}

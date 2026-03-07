<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkDetails extends Model
{
    protected $fillable = [
        'idno',
        'professional_level',
        'employment_status',
        'employment_type',
        'self_employed_spec',
        'others_specify',
        'job_history',
        'specify_country',
        'other_specify',
        'exploring_job',
        'distance_job',
        'job_roles',
        'job_shift',
        'skills',
    ];
    protected $casts = [
        'skills' => 'array',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkDetails extends Model
{
    protected $fillable = [
        'idno',
        'educational_level',
        'professional_level',
        'job_history',
        'exploring_job',
        'distance_job',
        'job_roles',
        'job_shift',
    ];
}

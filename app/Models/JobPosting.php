<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected static function booted()
    {
        static::creating(function ($job) {
            // Generates a random 8-digit number for job_id
            $job->job_id = random_int(10000000, 99999999);

            // Ensure the job_id is unique in the jobs table
            while (static::where('job_id', $job->job_id)->exists()) {
                $job->job_id = random_int(10000000, 99999999);
            }
        });
    }
    protected $fillable = [
        'idno',
        'job_id',
        'job_type',
        'job_category',
        'skills_required',
        'job_title',
        'job_description',
        'job_requirements',
        'province',
        'town',
        'barangay',
        'latitude',
        'longitude',
        'sex_preference',
        'num_positions',
        'is_active',
    ];
    protected $casts = [
        'skills_required' => 'array',
    ];
}

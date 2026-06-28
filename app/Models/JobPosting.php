<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected static function booted()
    {
        static::creating(function ($job) {
            // 1. Generate the prefix string: J + Month(mm) + Day(dd) + Year(yy)
            // Example for today: J062826
            $prefix = 'J' . now()->format('mdy');

            // 2. Combine the prefix with a random unique number block
            $job->job_id = $prefix . random_int(1000, 9999);

            // 3. Keep regenerating inside a loop if it happens to collide
            while (static::where('job_id', $job->job_id)->exists()) {
                $job->job_id = $prefix . random_int(1000, 9999);
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
        'flag_count'
    ];

    protected $casts = [
        'skills_required' => 'array',
    ];

    public function applicants()
    {
        return $this->belongsToMany(User::class, 'job_applications', 'job_id', 'user_id', 'job_id', 'idno')
                ->withPivot('id', 'status')
                ->withTimestamps();
    }
    public function interviewees()
    {
        return $this->belongsToMany(User::class, 'job_interviewees', 'job_id', 'user_id', 'job_id', 'idno')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}

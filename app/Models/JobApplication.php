<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    // Tell Laravel explicitly to look at your custom table name
    protected $table = 'job_applications';

    protected $fillable = [
        'user_id',
        'job_id',
        'status'
    ];

    /**
     * Get the applicant user that owns this application instance.
     */
    public function user()
    {
        // Change from belongsToMany to belongsTo (Singular: an application belongs to ONE user)
        return $this->belongsTo(User::class, 'user_id', 'idno');
    }

    /**
     * Get the job posting associated with this application instance.
     */
    public function jobPosting()
    {
        // An application belongs to ONE specific job posting
        return $this->belongsTo(JobPosting::class, 'job_id', 'job_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSave extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'requirements',
        'type',
        'location',
        'distance',
        'is_active',
        'flag_count'
    ];

    /**
     * The users who have saved/applied for this job.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'job_user')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}

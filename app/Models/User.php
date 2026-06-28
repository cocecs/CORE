<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\JobPosting;

// class User extends Authenticatable
// {
//     protected static function booted()
//     {
//         static::creating(function ($user) {
//             // Generates a random 8-digit number
//             $user->idno = random_int(10000000, 99999999);

//             // To ensure uniqueness, you can use a loop:
//             while (static::where('idno', $user->idno)->exists()) {
//                 $user->idno = random_int(10000000, 99999999);
//             }
//         });
//     }
//     /** @use HasFactory<\Database\Factories\UserFactory> */
//     use HasFactory, Notifiable;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var list<string>
//      */
//     protected $fillable = [
//         'firstname',
//         'lastname',
//         'email',
//         'password',
//         'usertype',
//     ];

//     /**
//      * The attributes that should be hidden for serialization.
//      *
//      * @var list<string>
//      */
//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     /**
//      * Get the attributes that should be cast.
//      *
//      * @return array<string, string>
//      */
//     protected function casts(): array
//     {
//         return [
//             'email_verified_at' => 'datetime',
//             'password' => 'hashed',
//         ];
//     }
// }

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected static function booted()
    {
        static::creating(function ($user) {
            // Generates a random 8-digit number
            $user->idno = random_int(10000000, 99999999);

            // To ensure uniqueness, you can use a loop:
            while (static::where('idno', $user->idno)->exists()) {
                $user->idno = random_int(10000000, 99999999);
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
        'usertype',
        // 'firstname' and 'lastname' removed here since they live in UserDetail now
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the profile/personal details associated with the user.
     */
    public function details(): HasOne
    {
        return $this->hasOne(UserDetails::class, 'idno', 'idno');
    }

    public function userDetails(): HasOne
    {
        // Parameter 2: Foreign key inside the 'user_details' table (idno)
        // Parameter 3: Local key inside the 'users' table (idno)
        return $this->hasOne(UserDetails::class, 'idno', 'idno');
    }
    public function savedJobs()
    {
        // This maps to a pivot table named 'job_user' or 'saved_jobs'
        return $this->belongsToMany(JobPosting::class, 'job_saves', 'user_id', 'job_id', 'idno', 'job_id')
                ->withPivot('status')
                ->withTimestamps();
    }
    public function appliedJobs()
    {
        return $this->belongsToMany(JobPosting::class, 'job_applications', 'user_id', 'job_id', 'idno', 'job_id')
                ->withPivot('status')
                ->withTimestamps();
    }
    public function interviewingJobs()
    {
        return $this->belongsToMany(JobPosting::class, 'job_interviewees', 'user_id', 'job_id', 'idno', 'job_id')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetails extends Model
{
    protected $fillable = [
        'idno',
        'firstname',
        'lastname',
        'middlename',
        'ext',
        'middlename',
        'ext',
        'date_of_birth',
        'province',
        'town',
        'brgy',
        'address',
        'latitude',
        'longitude',
        'tel_no',
        'mobile_no',
        'sex',
        'gender',
        'civil_status',
        'educational_level',
        'course_id',
        'about_me',
    ];
    public function account(): BelongsTo
    {
        // Parameter 2: Foreign key inside 'user_details' table
        // Parameter 3: Owner key inside 'users' table
        return $this->belongsTo(User::class, 'idno', 'idno');
    }
    public function course()
    {
        // Maps user_details.course_id to courses.id
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}

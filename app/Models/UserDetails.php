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
        // 'latitude',
        // 'longitude',
        'tel_no',
        'mobile_no',
        'sex',
        'gender',
        'civil_status',
        'educational_level',
        'about_me',
    ];
    public function account(): BelongsTo
    {
        // Parameter 2: Foreign key inside 'user_details' table
        // Parameter 3: Owner key inside 'users' table
        return $this->belongsTo(User::class, 'idno', 'idno');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPreference extends Model
{
    protected $fillable = [
        'idno',
        'pref_occ',
        'work_location',
        'specific_location',
        'specify_country',
    ];
    protected $casts = [
        'pref_occ' => 'string',
        'work_location' => 'string',
        'specific_location' => 'string',
        'specify_country' => 'string',

    ];
}

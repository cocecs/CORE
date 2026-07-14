<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPreference extends Model
{
    protected $fillable = [
        'idno',
        'pref_occ',
        'work_location',
        'province',
        'town',
        'latitude',
        'longitude',
        'specify_country',
    ];
    protected $casts = [
        'pref_occ' => 'string',
        'work_location' => 'string',
        'province' => 'string',
        'town' => 'string',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'specify_country' => 'string',

    ];
}

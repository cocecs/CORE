<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $fillable = [
        'idno',
        'firstname',
        'lastname',
        'middlename',
        'ext',
        'date_of_birth',
        'province',
        'town',
        'address',
        'tel_no',
        'mobile_no',
        'sex',
        'civil_status',
        'about_me',
    ];
}

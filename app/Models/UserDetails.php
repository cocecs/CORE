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
        'brgy',
        'address',
        'tel_no',
        'mobile_no',
        'gender',
        'civil_status',
        'about_me',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $fillable = [
        'idno',
        'email',
        'company_name',
        'province',
        'town',
        'brgy',
        'address_details',
        'tel',
        'phone',
        'representative_name',
        'mobile',
        'designation',
        'tin'
    ];
}

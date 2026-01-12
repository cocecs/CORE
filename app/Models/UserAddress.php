<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'province',
        'town',
        'address',
        'tel_no',
        'mobile_no',
    ];
}

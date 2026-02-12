<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSex extends Model
{
    protected $fillable = [
        'gender',
        'civil_status',
    ];
}

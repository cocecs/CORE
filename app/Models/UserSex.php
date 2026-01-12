<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSex extends Model
{
    protected $fillable = [
        'sex',
        'civil_status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Educational extends Model
{
    protected $fillable = [
        'idno',
        'level',
        'institution',
        'degree',
        'year_start',
        'year_completed'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalDetail extends Model
{
    protected $table = 'educational_details';

    protected $fillable = [
        'idno',
        'educ_level',
        'school',
        'course_name',
        'year_graduated',
        'skills',
    ];
}

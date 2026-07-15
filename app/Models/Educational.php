<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Educational extends Model
{
    protected $fillable = [
        'idno',
        'elementary_school',
        'basic_education',
        'elementary_graduated',
        'secondary_school',
        'senior_high_strand',
        'secondary_graduated',
        'vocational_school',
        'vocational_course',
        'vocational_graduated',
        'vocational_skills',
        'tertiary_school',
        'course_degree',
        'tertiary_graduated',
        'bachelor_skills',
        'postgrad_school',
        'postgrad_course_degree',
        'postgrad_graduated',
        'bachelor_skills',
        'masters_skills',
        'doctoral_school',
        'doctoral_course_degree',
        'doctoral_graduated',
        'doctoral_skills',
    ];
}

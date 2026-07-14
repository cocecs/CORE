<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class CourseAlias extends Model
{
    protected $fillable = [
        'course_id',
        'alias_keyword',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

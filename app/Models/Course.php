<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Course extends Model
{
    protected $fillable = [
        'expertise_id',
        'display_name',
    ];
    public function expertise()
    {
        // Maps courses.expertise_id to expertises.id based on your schema layout
        return $this->belongsTo(Expertise::class, 'expertise_id', 'id');
    }
    public function aliases()
    {
        return $this->hasMany(CourseAlias::class);
    }
}

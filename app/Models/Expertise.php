<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    protected static function newFactory()
    {
        return \Database\Factories\ExpertiseFactory::new();
    }
    use HasFactory;
    protected $fillable = [
        'exp_code',
        'area_of_expertise',
    ];
}

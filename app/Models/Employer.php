<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employer extends Model
{
    protected $fillable = [
        'idno',
        'email',
        'company_name',
        'type_of_business',
        'province',
        'town',
        'brgy',
        'address_details',
        'tel',
        'phone',
        'representative_name',
        'mobile',
        'designation',
        'tin',
        'about',
    ];
    public function account(): BelongsTo
    {
        // Parameter 2: Foreign key inside 'user_details' table
        // Parameter 3: Owner key inside 'users' table
        return $this->belongsTo(User::class, 'idno', 'idno');
    }
}

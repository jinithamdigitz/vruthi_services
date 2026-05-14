<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScrapRequest extends Model
{
    protected $fillable = [

        'full_name',

        'phone',

        'email',

        'location',

        'scrap_type',

        'details'

    ];

    protected $casts = [

        'scrap_type' => 'array'

    ];
}

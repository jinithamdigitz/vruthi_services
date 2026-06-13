<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',

        'short_description',

        'body',

        'features',

        'show_html',

        'image',

        'icon_image',

        'keyword',

        'sort_order',

        'is_active',
    ];

    protected $casts = [
        'show_html' => 'boolean',
        'is_active' => 'boolean',
    ];
}
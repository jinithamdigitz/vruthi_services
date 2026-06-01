<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'body',
        'show_html',
        'image',
        'icon_image',
        'keyword',
    ];

    protected $casts = [
        'show_html' => 'boolean',
    ];
}

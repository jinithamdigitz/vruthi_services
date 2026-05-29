<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomCss extends Model
{
    protected $table = 'custom_css';

    protected $fillable = [
        'content_css',
    ];
}
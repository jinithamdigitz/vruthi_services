<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'body',
        'sort_order',
    ];

    protected static function boot()
    {
        parent::boot();
        
        // Global scope to order by sort_order ascending
        static::addGlobalScope('order', function ($query) {
            $query->orderBy('sort_order', 'asc');
        });
    }
}

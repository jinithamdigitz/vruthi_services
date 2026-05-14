<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $fillable = [
        'course_name',
        'slug',
        'description',
        'image',
        'duration',
        'level',
        'status'
    ];

    // Auto-generate slug when creating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            $course->slug = Str::slug($course->course_name);
        });

        static::updating(function ($course) {
            if ($course->isDirty('course_name')) {
                $course->slug = Str::slug($course->course_name);
            }
        });
    }

    // Get route key name for routing
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
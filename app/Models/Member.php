<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'description',
        'image',
        'slug',
        'keyword'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($member) {
            if (empty($member->slug)) {
                $member->slug = Str::slug($member->name);
            }
            // Ensure unique slug
            $originalSlug = $member->slug;
            $count = 1;
            while (static::where('slug', $member->slug)->exists()) {
                $member->slug = $originalSlug . '-' . $count++;
            }
        });

        static::updating(function ($member) {
            if ($member->isDirty('name') && empty($member->slug)) {
                $member->slug = Str::slug($member->name);
                $originalSlug = $member->slug;
                $count = 1;
                while (static::where('slug', $member->slug)->where('id', '!=', $member->id)->exists()) {
                    $member->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
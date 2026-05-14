<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug', // Add slug to fillable
        'description',
        'image',
        'skills',
        'experience',
        'project_category_id'
    ];

    protected $casts = [
        'skills' => 'array'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        
        // Auto-generate slug when creating
        static::creating(function ($project) {
            $project->slug = Str::slug($project->name);
        });
        
        // Update slug when name changes
        static::updating(function ($project) {
            if ($project->isDirty('name')) {
                $project->slug = Str::slug($project->name);
            }
        });
    }

    /**
     * Get the category that owns the project.
     */
    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }

    /**
     * Get the image URL.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path($this->image))) {
            return asset($this->image);
        }
        
        return asset('assets/images/project-default.jpg');
    }

    /**
     * Get formatted skills as array.
     */
    public function getSkillsListAttribute()
    {
        if (is_array($this->skills)) {
            return $this->skills;
        }
        
        return array_filter(array_map('trim', explode(',', $this->skills ?? '')));
    }

    /**
     * Get the multiple images for this project.
     */
    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }
    
    /**
     * Get route key for implicit binding.
     */
    public function getRouteKeyName()
    {
        return 'slug'; // Use slug instead of id for route binding
    }
}
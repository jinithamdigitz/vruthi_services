<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    protected $fillable = [
        'project_id',
        'image'
    ];

    /**
     * علاقة مع المشروع
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get image URL
     */
    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path($this->image))) {
            return asset($this->image);
        }

        return asset('assets/images/project-default.jpg');
    }
}
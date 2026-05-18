<?php
// app/Models/CareerJob.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CareerJob extends Model
{
    use HasFactory;

    protected $table = 'career_jobs';

    protected $fillable = [
        'title',
        'slug',
        'department',
        'location',
        'employment_type',
        'experience',
        'short_description',
        'description',
        'status',
        'created_date'
    ];

    protected $casts = [
        'status' => 'boolean',
        'created_date' => 'date',
        'experience' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($careerJob) {
            $careerJob->slug = Str::slug($careerJob->title . '-' . uniqid());
        });

        static::updating(function ($careerJob) {
            if ($careerJob->isDirty('title')) {
                $careerJob->slug = Str::slug($careerJob->title . '-' . uniqid());
            }
        });
    }

    public function getStatusBadgeAttribute()
    {
        return $this->status 
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-danger">Inactive</span>';
    }

    public function getEmploymentTypeBadgeAttribute()
    {
        $badges = [
            'full-time' => 'bg-primary',
            'part-time' => 'bg-info',
            'contract' => 'bg-warning',
            'freelance' => 'bg-secondary',
            'internship' => 'bg-dark'
        ];

        $badgeClass = $badges[$this->employment_type] ?? 'bg-secondary';
        
        return "<span class='badge {$badgeClass}'>" . ucfirst($this->employment_type) . "</span>";
    }
}
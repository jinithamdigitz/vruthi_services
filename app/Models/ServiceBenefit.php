<?php
// app/Models/ServiceBenefit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceBenefit extends Model
{
    use HasFactory;

    protected $table = 'service_benefits';

    protected $fillable = [
        'service_id',
        'title',
        'image',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    // Get image URL from public/uploads folder
    public function getImageUrlAttribute(): string
    {
        if ($this->image && file_exists(public_path('uploads/' . $this->image))) {
            return asset('uploads/' . $this->image);
        }
        return asset('images/default-benefit.png');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
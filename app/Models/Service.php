<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
   public function benefits(): HasMany
    {
        return $this->hasMany(ServiceBenefit::class);
    }

    /**
     * Get only active benefits for this service
     */
    public function activeBenefits(): HasMany
    {
        return $this->hasMany(ServiceBenefit::class)->where('is_active', true);
    }

    
}
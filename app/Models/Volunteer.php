<?php
// app/Models/Volunteer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'location',
        'preferred_causes',
        'availability',
        'gdpr_consent',
        'status'
    ];

    protected $casts = [
        'preferred_causes' => 'array',
        'gdpr_consent' => 'boolean',
        
    ];

    public function getPreferredCausesFormattedAttribute()
    {
        return implode(', ', $this->preferred_causes ?? []);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
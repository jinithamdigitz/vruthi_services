<?php
// app/Models/EwasteDonation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EwasteDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'donor_type',
        'pickup_location',
        'waste_type',
        'message',
        'gdpr_consent',
        'status'
    ];

    protected $casts = [
        'gdpr_consent' => 'boolean',
    ];

    // Donor type options
    const DONOR_TYPES = [
        'Individual/Residential',
        'Association/Education', 
        'Institution/Corporate/Commercial',
        'Establishment'
    ];

    // Common waste types
    const WASTE_TYPES = [
        'Computers & Laptops',
        'Mobile Phones & Tablets',
        'Televisions & Monitors',
        'Printers & Scanners',
        'Batteries',
        'Chargers & Cables',
        'Electronic Toys',
        'Kitchen Appliances',
        'Other Electronic Items'
    ];

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function getDonorTypeBadgeAttribute()
    {
        $badges = [
            'Individual/Residential' => 'bg-primary',
            'Association/Education' => 'bg-success', 
            'Institution/Corporate/Commercial' => 'bg-info',
            'Establishment' => 'bg-warning'
        ];

        return $badges[$this->donor_type] ?? 'bg-secondary';
    }
}
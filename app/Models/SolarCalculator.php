<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolarCalculator extends Model
{
    protected $fillable = [
        'name',
        'location',
        'contact_number',
        'email',
        'daily_consumption',
        'monthly_bill',
        'system_type',
        'estimated_savings',
    ];
}
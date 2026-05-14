<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'company',
        'service_interest',
        'city',
        'project_description',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the service details (relationship)
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_interest', 'slug');
    }

    /**
     * Get service interest as formatted text (dynamic from database)
     */
    public function getServiceInterestTextAttribute()
    {
        // If it's "other", return "Other Services"
        if ($this->service_interest === 'other') {
            return 'Other Services';
        }
        
        // Try to get the service from database
        $service = Service::where('slug', $this->service_interest)->first();
        
        if ($service) {
            return $service->title;
        }
        
        // Fallback: format the slug to readable text
        return ucfirst(str_replace('_', ' ', $this->service_interest));
    }

    /**
     * Get city as formatted text
     */
    public function getCityTextAttribute()
    {
        $cities = [
            'thiruvananthapuram' => 'Thiruvananthapuram',
            'kollam' => 'Kollam',
            'pathanamthitta' => 'Pathanamthitta',
            'alappuzha' => 'Alappuzha',
            'kottayam' => 'Kottayam',
            'idukki' => 'Idukki',
            'ernakulam' => 'Ernakulam/Kochi',
            'thrissur' => 'Thrissur',
            'palakkad' => 'Palakkad',
            'malappuram' => 'Malappuram',
            'kozhikode' => 'Kozhikode',
            'wayanad' => 'Wayanad',
            'kannur' => 'Kannur',
            'kasaragod' => 'Kasaragod'
        ];

        return $cities[$this->city] ?? ucfirst(str_replace('_', ' ', $this->city));
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'contacted' => 'info',
            'completed' => 'success',
            'archived' => 'secondary',
            default => 'light'
        };
    }

    /**
     * Get status text
     */
    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'pending' => 'Pending',
            'contacted' => 'Contacted',
            'completed' => 'Completed',
            'archived' => 'Archived',
            default => 'Unknown'
        };
    }

    /**
     * Scope for pending submissions
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for today's submissions
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Scope for submissions by service
     */
    public function scopeByService($query, $serviceSlug)
    {
        return $query->where('service_interest', $serviceSlug);
    }

    /**
     * Scope for search
     */
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function($q) use ($searchTerm) {
            $q->where('full_name', 'like', "%{$searchTerm}%")
              ->orWhere('email', 'like', "%{$searchTerm}%")
              ->orWhere('phone', 'like', "%{$searchTerm}%")
              ->orWhere('company', 'like', "%{$searchTerm}%")
              ->orWhere('service_interest', 'like', "%{$searchTerm}%")
              ->orWhere('project_description', 'like', "%{$searchTerm}%");
        });
    }

    /**
     * Get all service options for dropdown (dynamic from database)
     */
    public static function getServiceOptions()
    {
        $services = Service::orderBy('title')->get();
        
        $options = [];
        foreach ($services as $service) {
            $options[$service->slug] = $service->title;
        }
        $options['other'] = 'Other Services';
        
        return $options;
    }

    /**
     * Get all city options
     */
    public static function getCityOptions()
    {
        return [
            'thiruvananthapuram' => 'Thiruvananthapuram',
            'kollam' => 'Kollam',
            'pathanamthitta' => 'Pathanamthitta',
            'alappuzha' => 'Alappuzha',
            'kottayam' => 'Kottayam',
            'idukki' => 'Idukki',
            'ernakulam' => 'Ernakulam/Kochi',
            'thrissur' => 'Thrissur',
            'palakkad' => 'Palakkad',
            'malappuram' => 'Malappuram',
            'kozhikode' => 'Kozhikode',
            'wayanad' => 'Wayanad',
            'kannur' => 'Kannur',
            'kasaragod' => 'Kasaragod'
        ];
    }

    /**
     * Get status options
     */
    public static function getStatusOptions()
    {
        return [
            'pending' => 'Pending',
            'contacted' => 'Contacted',
            'completed' => 'Completed',
            'archived' => 'Archived'
        ];
    }

    /**
     * Check if submission is new (less than 24 hours old)
     */
    public function getIsNewAttribute()
    {
        return $this->created_at->diffInHours(now()) < 24;
    }

    /**
     * Mark as contacted
     */
    public function markAsContacted()
    {
        $this->update(['status' => 'contacted']);
    }

    /**
     * Mark as completed
     */
    public function markAsCompleted()
    {
        $this->update(['status' => 'completed']);
    }

    /**
     * Archive submission
     */
    public function archive()
    {
        $this->update(['status' => 'archived']);
    }
}
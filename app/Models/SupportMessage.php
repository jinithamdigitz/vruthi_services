<?php
// app/Models/SupportMessage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email', 
        'phone',
        'subject',
        'message',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope for new messages
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    // Scope for resolved messages
    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }

    // Get status badge class
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'new' => 'badge bg-primary',
            'in_progress' => 'badge bg-warning',
            'resolved' => 'badge bg-success',
            'closed' => 'badge bg-secondary'
        ];

        return $badges[$this->status] ?? 'badge bg-secondary';
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'project_type',
        'message',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    // Scope for unread messages
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Scope for read messages
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    // Mark as read
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }
}
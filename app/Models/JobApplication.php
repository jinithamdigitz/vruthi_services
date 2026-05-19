<?php
// app/Models/JobApplication.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $table = 'job_applications';

    protected $fillable = [
        'job_id',
        'job_title',
        'job_department',
        'job_location',
        'job_type',
        'full_name',
        'email',
        'phone',
        'country_code',
        'location',
        'experience',
        'cover_letter',
        'resume_path',
        'resume_original_name',
        'resume_file_size',
        'status',
        'admin_notes',
        'reviewed_at',
        'reviewed_by',
        'ip_address',
        'user_agent',
        'terms_agreed'
    ];

    protected $casts = [
        'terms_agreed' => 'boolean',
        'reviewed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_REVIEWED = 'reviewed';
    const STATUS_SHORTLISTED = 'shortlisted';
    const STATUS_REJECTED = 'rejected';
    const STATUS_HIRED = 'hired';

    // Get all statuses
    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_REVIEWED => 'Reviewed',
            self::STATUS_SHORTLISTED => 'Shortlisted',
            self::STATUS_REJECTED => 'Rejected',
            self::STATUS_HIRED => 'Hired',
        ];
    }

    // Relationships
    public function job()
    {
        return $this->belongsTo(CareerJob::class, 'job_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $badges = [
            self::STATUS_PENDING => 'badge bg-warning',
            self::STATUS_REVIEWED => 'badge bg-info',
            self::STATUS_SHORTLISTED => 'badge bg-primary',
            self::STATUS_REJECTED => 'badge bg-danger',
            self::STATUS_HIRED => 'badge bg-success',
        ];

        $badgeClass = $badges[$this->status] ?? 'badge bg-secondary';
        
        return "<span class='{$badgeClass}'>" . ucfirst($this->status) . "</span>";
    }

    public function getFullPhoneAttribute()
    {
        return $this->country_code . ' ' . $this->phone;
    }

    public function getResumeUrlAttribute()
    {
        return $this->resume_path ? asset('storage/' . $this->resume_path) : null;
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('F d, Y H:i:s');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeReviewed($query)
    {
        return $query->where('status', self::STATUS_REVIEWED);
    }

    public function scopeShortlisted($query)
    {
        return $query->where('status', self::STATUS_SHORTLISTED);
    }

    public function scopeByJob($query, $jobId)
    {
        return $query->where('job_id', $jobId);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month);
    }

    // Helper methods
    public function markAsReviewed($userId = null)
    {
        $this->status = self::STATUS_REVIEWED;
        $this->reviewed_at = now();
        $this->reviewed_by = $userId;
        $this->save();
    }

    public function markAsShortlisted()
    {
        $this->status = self::STATUS_SHORTLISTED;
        $this->save();
    }

    public function markAsRejected()
    {
        $this->status = self::STATUS_REJECTED;
        $this->save();
    }

    public function markAsHired()
    {
        $this->status = self::STATUS_HIRED;
        $this->save();
    }

    public function addNote($note)
    {
        $this->admin_notes = ($this->admin_notes ? $this->admin_notes . "\n---\n" : '') . now()->format('Y-m-d H:i:s') . ": " . $note;
        $this->save();
    }
}
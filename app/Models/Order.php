<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'razorpay_order_id',
        'razorpay_payment_id', // NEW
        'razorpay_signature', // NEW
        'amount',
        'name',
        'email_id', // Keep as email_id (your existing column)
        'order_status',
        'address',
        'phonenumber', // Keep as phonenumber (your existing column)
        'message',
        'donor_type', // NEW
        'preferred_cause', // NEW
        'gdpr_consent', // NEW
        'payment_status' // NEW
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'gdpr_consent' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    const DONOR_TYPES = [
        'Individual/Residential',
        'Association/Education', 
        'Institution/Corporate/Commercial',
        'Establishment'
    ];

    // Preferred cause options
    const CAUSES = [
        'Collection Drive',
        'E-Waste Awareness',
        'Sustainability Education Sessions',
        'Educational Institutions'
    ];

    // Amount presets
    const AMOUNT_PRESETS = [1000, 2000, 5000, 10000];

    public function scopeMoneyDonations($query)
    {
        return $query->whereNotNull('donor_type');
    }

    public function scopePending($query)
    {
        return $query->where('order_status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('order_status', 'completed');
    }

    public function scopeSuccessfulPayments($query)
    {
        return $query->where('payment_status', 'success');
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

    public function getFormattedAmountAttribute()
    {
        return '₹' . number_format($this->amount, 2);
    }

    public function isPaymentSuccessful()
    {
        return $this->payment_status === 'success';
    }

    public function isMoneyDonation()
    {
        return !is_null($this->donor_type);
    }

    /**
     * Get the email attribute (accessor for email_id)
     */
    public function getEmailAttribute()
    {
        return $this->email_id;
    }

    /**
     * Set the email attribute (mutator for email_id)
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email_id'] = $value;
    }

    /**
     * Get the phone attribute (accessor for phonenumber)
     */
    public function getPhoneAttribute()
    {
        return $this->phonenumber;
    }

    /**
     * Set the phone attribute (mutator for phonenumber)
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phonenumber'] = $value;
    }
}
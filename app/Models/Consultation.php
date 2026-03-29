<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'expert_id',
        'farmer_id',
        'date',
        'time',
        'notes',
        'status',
        'payment_status',
        'transaction_id',
    ];

    // Relationships
    public function expert()
    {
        return $this->belongsTo(User::class, 'expert_id');
    }

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    public function refund()
    {
        return $this->hasOne(Refund::class, 'booking_id');
    }

    public function getRefundStatusAttribute()
    {
        return $this->refund ? $this->refund->status : null;
    }

}

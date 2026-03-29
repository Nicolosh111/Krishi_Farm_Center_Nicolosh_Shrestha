<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'amount',
        'status',
        'reason',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'booking_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

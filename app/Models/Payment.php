<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
     use HasFactory;

    protected $fillable = [
        'farmer_id',
        'expert_id',
        'amount',
        'status',
        'purpose',
        'transaction_id',
    ];

    // Relationships
    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    public function expert()
    {
        return $this->belongsTo(User::class, 'expert_id');
    }

}

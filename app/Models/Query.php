<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    protected $fillable = [
        'crop_id',
        'disease_id',
        'user_id',
        'question',
        'status',
    ];

      public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

    // Relationship to Disease
    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

    // Relationship to Farmer/User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Replies
    public function replies()
    {
        return $this->hasMany(QueryReply::class, 'query_id');
    }
}

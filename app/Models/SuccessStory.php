<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessStory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'farmer_name',
        'location',
        'description',
        'image_url',
        'status',
        'user_id',
        'likes_count',
    ];

     /**
     * Each success story belongs to one user (farmer).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

}

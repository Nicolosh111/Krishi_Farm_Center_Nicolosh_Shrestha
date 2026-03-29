<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Resource extends Model
{
    protected $fillable = ['crop_id','disease_id','title', 'file', 'type','user_id','link'];


     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

     public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

    protected static function booted()
{
    static::creating(function ($resource) {
        if (Auth::check()) {
            $resource->user_id = Auth::id();
        }
    });
}
}

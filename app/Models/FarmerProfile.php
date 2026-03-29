<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerProfile extends Model
{
        protected $fillable = [
        'user_id','profile_image','location','experience',
        'phone','bio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

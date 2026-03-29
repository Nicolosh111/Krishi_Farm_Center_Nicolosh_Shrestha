<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpertProfile extends Model
{
    protected $fillable = [
        'user_id','profile_image','specialization','qualification',
        'experience_years','consultation_fee','phone','bio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

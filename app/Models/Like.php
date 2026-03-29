<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'success_story_id'];

    public function story()
    {
        return $this->belongsTo(SuccessStory::class, 'success_story_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

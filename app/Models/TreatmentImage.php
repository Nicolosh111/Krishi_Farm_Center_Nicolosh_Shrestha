<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreatmentImage extends Model
{
      protected $fillable = ['file','title', 'disease_id'];

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

}

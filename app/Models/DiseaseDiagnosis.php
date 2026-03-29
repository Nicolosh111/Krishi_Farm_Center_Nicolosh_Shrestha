<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseDiagnosis extends Model
{
     use HasFactory;

    protected $fillable = [
        'plant_image_id',
        'expert_id',
        'disease_id',
    ];

    // Relationships
    public function plantImage()
    {
        return $this->belongsTo(PlantImage::class);
    }

    public function expert()
    {
        return $this->belongsTo(User::class, 'expert_id');
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class, 'disease_id');
    }


}

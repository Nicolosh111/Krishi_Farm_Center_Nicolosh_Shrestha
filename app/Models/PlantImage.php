<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'crop_id',
        'file_path',
        'original_name',
    ];

     // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function diagnoses()
    {
        return $this->hasMany(DiseaseDiagnosis::class);
    }

     // Crop associated with this image
    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }


}

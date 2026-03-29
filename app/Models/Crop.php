<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',
        'name',
        'description',
        'region',
        'best_season',
        'status',
        'soil_type',
        'cultivation_practices',
        'yield_potential',
    ];

        public function user()
    {
        return $this->belongsTo(User::class);
    }
    // A crop can have many diseases
    public function diseases()
    {
        return $this->hasMany(Disease::class);
    }

        public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function cropResources()
    {
        return $this->hasMany(Resource::class)->whereNull('disease_id');
    }

    public function diseaseResources()
    {
        return $this->hasMany(Resource::class)->whereNotNull('disease_id');
    }

    // One crop can have many plant images
    public function plantImages()
    {
        return $this->hasMany(PlantImage::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $fillable = [
        'user_id','name','crop_id','image','symptoms','cause',
        'prevention','treatment','severity','status','type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Each disease belongs to a crop
    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

        public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function diagnoses()
    {
        return $this->hasMany(DiseaseDiagnosis::class, 'disease_id');
    }

    public function treatmentImages()
    {
        return $this->hasMany(TreatmentImage::class);
    }
}

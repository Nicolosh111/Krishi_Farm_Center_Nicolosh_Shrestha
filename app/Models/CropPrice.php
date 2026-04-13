<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CropPrice extends Model
{
     protected $fillable = [
        'crop_name',
        'location',
        'unit',
        'price',
        'min_price',
        'max_price',
        'date',
    ];
}

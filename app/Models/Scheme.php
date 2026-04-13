<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scheme extends Model
{
    
    protected $fillable = [
        'title',
        'description',
        'eligibility',
        'documents_required',
        'valid_until',
        'link',
    ];
}

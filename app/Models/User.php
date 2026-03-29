<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_approved',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //relationships
    public function plantImages()
    {
        return $this->hasMany(PlantImage::class);
    }

    // If the user is an expert, they have made many diagnoses
    public function diagnoses()
    {
        return $this->hasMany(DiseaseDiagnosis::class, 'expert_id');
    }

    public function successStories()
    {
        return $this->hasMany(SuccessStory::class);
    }

     public function expertProfile()
    {
        return $this->hasOne(ExpertProfile::class);
    }

    public function farmerProfile()
    {
        return $this->hasOne(FarmerProfile::class);
    }

}



<?php

// app/Models/User.php  

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $fillable = ['poadcast_id', 'name', 'email', 'password', 'email_verified_at'];

    protected $hidden = ['password', 'remember_token'];


    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) =>  Hash::make($value),
        );
    }

    public function media(): MorphMany
    {

        return $this->morphMany(Media::class, 'image');
    }

    public function poadcasts()
    {
        return $this->hasMany(Poadcast::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likedPoadcasts()
    {
        return $this->belongsToMany(Poadcast::class, 'poadcast_likes')->withTimestamps();
    }
}

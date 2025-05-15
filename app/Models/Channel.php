<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Channel extends Model
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $fillable = ['id','user_id', 'name', 'description']; 	


    public function user(){
        $this->belongsTo(User::class);
    }

    public function poadcasts(){
       return $this->hasMany(Poadcast::class);
    }


    public function subscribers() {
        return $this->belongsToMany(User::class, 'channel_user'); 
    }
}

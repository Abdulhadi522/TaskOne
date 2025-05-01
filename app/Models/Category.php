<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Category extends Model
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $fillable = ['name'];  

    public function poadcasts():BelongsToMany
    {  
        return $this->belongsToMany(Poadcast::class);  
    }  

}

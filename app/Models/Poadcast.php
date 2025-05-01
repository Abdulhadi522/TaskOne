<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Poadcast extends Model
{
    use HasFactory;
    
    protected $fillable = ['id','user_id','title','description','audio_file' ,'cover_image','category_id'];

    public function user() {  
        return $this->belongsTo(User::class);  
    }  

    public function comments() {  
        return $this->hasMany(Comment::class);  
    } 

    public function likes()  
    {  
        return $this->hasMany(Like::class);  
    }  

    public function categories():BelongsToMany
    {  
        return $this->belongsToMany(Category::class);  
    }  
     
}

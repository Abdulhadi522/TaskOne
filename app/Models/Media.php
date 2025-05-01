<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory;  

    protected $fillable = ['image_path'];
    // Define the inverse of the morph relationship  
    
    public function image(): MorphTo
    {  
        return $this->morphTo();  
    }  
}

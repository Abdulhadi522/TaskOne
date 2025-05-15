<?php
namespace App\Actions;
use App\Models\Media;

class UploadImageAction
{
        public function StoreImage($path){
        $media = Media::create([  
            'image_path' => $path,  
        ]); 


        return $media;
        
    }
}
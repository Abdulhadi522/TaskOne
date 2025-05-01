<?php

namespace App\Services;


use App\Http\Requests\ImageRequest;
use App\Models\Media;
use App\Trait\ResponseStorageTrait;
use Illuminate\Support\Str;


class ImageService{

    use ResponseStorageTrait;
    
    public function GenerateName(ImageRequest $request){

        $filename = Str::random(10) . '_' . time() . '.' . $request->file('image_path')->getClientOriginalExtension();  

        return $filename;
    }

    public function ImagePath(ImageRequest $request, $ImageName){

        $path = $request->file('image_path')->storeAs('images', $ImageName, 'public');
        return $path;  
    }

    public function StoreImage($path){
        $media = Media::create([  
            'image_path' => $path,  
        ]); 


        return $media;
        
    }
}
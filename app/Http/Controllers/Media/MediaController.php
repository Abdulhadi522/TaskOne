<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Services\ImageService;
use App\Trait\ResponseStorageTrait;


class MediaController extends Controller
{
    use ResponseStorageTrait;
    protected $imageService;

    public function __construct(ImageService $imageService)
    {

        $this->imageService = $imageService;
    }

    public function StoreImage(ImageRequest $request)
    {


        $ImageName = $this->imageService->GenerateName($request);


        $path = $this->imageService->ImagePath($request, $ImageName);


        $this->imageService->StoreImage($path);

       return  $this->SuccessResponse('Your Image Stored Successfully');


    }
    
}

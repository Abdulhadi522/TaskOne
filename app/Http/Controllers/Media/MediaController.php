<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Services\ImageService;
use App\Trait\ResponseStorageTrait;
use App\Actions\UploadImageAction;

class MediaController extends Controller
{
    use ResponseStorageTrait;
    protected $imageService,$uploadImageAction;

    public function __construct(ImageService $imageService,UploadImageAction $uploadImageAction)
    {

        $this->imageService = $imageService;
        $this->uploadImageAction = $uploadImageAction;
    }

    public function StoreImage(ImageRequest $request)
    {


        $ImageName = $this->imageService->GenerateName($request);


        $path = $this->imageService->ImagePath($request, $ImageName);


        $this->uploadImageAction->StoreImage($path);

       return  $this->SuccessResponse('Your Image Stored Successfully');


    }
    
}

<?php
// app/Http/Controllers/PodcastController.php  

namespace App\Http\Controllers\Media;

use Illuminate\Http\Request;  

use App\Http\Controllers\Controller;
use App\Http\Requests\PoadcastRequest;
use App\Models\Poadcast;
use App\Services\PodcastService;
use App\Trait\ResponseStorageTrait;

class PoadcastController extends Controller
{
    use ResponseStorageTrait;

    protected $podcastService;

    public function __construct(PodcastService $podcastService)
    {

        $this->podcastService = $podcastService;
    }


    public function upload(PoadcastRequest $request)
    {

        $audioPath = $this->podcastService->AudioPath($request);

        $coverPath = $this->podcastService->CoverPath($request);

        $this->podcastService->StorePodcast($request, $audioPath, $coverPath);

        return $this->SuccessResponse('Your Podcast Uploaded Successfully', 200);
    }


    public function index(Request $request)
    {
        // Default to 10 podcasts per page, but allow customization through query parameter  
        $perPage = $request->input('per_page', 10);  

        // Fetch random podcasts  
        $podcasts = Poadcast::inRandomOrder()->paginate($perPage);

        return response()->json($podcasts);
    }
}

<?php
// app/Http/Controllers/PodcastController.php  

namespace App\Http\Controllers\Media;


use App\Http\Controllers\Controller;
use App\Http\Requests\PoadcastRequest;
use App\Http\Resources\PodcastRandomResource;
use App\Models\Poadcast;
use App\Services\PodcastService;
use App\Trait\ResponseStorageTrait;
use App\Actions\CreatePodcastAction;
use Illuminate\Support\Facades\Cache;

class PoadcastController extends Controller
{
    use ResponseStorageTrait;

    protected $podcastService, $createpodcast;

    public function __construct(PodcastService $podcastService, CreatePodcastAction $createpodcast)
    {

        $this->podcastService = $podcastService;
        $this->createpodcast = $createpodcast;
    }


    public function upload(PoadcastRequest $request)
    {

        $audioPath = $this->podcastService->AudioPath($request);

        $coverPath = $this->podcastService->CoverPath($request);

        $this->createpodcast->StorePodcast($request, $audioPath, $coverPath);

        return $this->SuccessResponse('Your Podcast Uploaded Successfully', 200);
    }


    public function index()
    {
        $randomIds = Poadcast::inRandomOrder()->limit(50)->pluck('id')->toArray();
        Cache::put('random_podcast_ids', $randomIds, now()->addMinutes(5));
        $randomIds = Cache::get('random_podcast_ids', []);
        $selected = collect($randomIds)->shuffle()->take(10);
        $podcasts = Poadcast::with(['categories', 'user'])
            ->whereIn('id', $selected)
            ->get();
        return PodcastRandomResource::collection($podcasts);
    }
}

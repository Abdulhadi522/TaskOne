<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PodcastRandomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'audio_file' => $this->audio_file,
            'cover_image' => $this->cover_image,
            'created_at' => $this->created_at->toDateTimeString(),


            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],

            'categories' => $this->categories->pluck('name'),


        ];
    }
}

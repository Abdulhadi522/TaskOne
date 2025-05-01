<?php

namespace App\Services;

use App\Models\Poadcast;
use App\Trait\ResponseStorageTrait;
use Carbon\Carbon;

class FilterService
{
    use ResponseStorageTrait;

    public function filter($request)
    {
        $query = Poadcast::query();

        // Filter by category_id 

        if ($request->filled('category_id')) {
            $query->whereHas('categories', fn($q) => $q->where('categories.id', $request->category_id));
            $result = $query->get();
            return  $this->FilterByCategoryId($result);
        }

        // Filter by most viewed  
        if ($request->filter === 'most_viewed') {
            $query->orderBy('views', 'desc');
            $result = $query->get();
            return $this->FilterByMostViews($result);
        }

        // Filter by trending
        elseif ($request->filter === 'trending') {
            $query->where('created_at', '>=', Carbon::now()->subDays(7))
                ->orderBy('views', 'desc');
            $result = $query->get();
            return $this->FilterByTrending($result);
        }

        // Default 
        else {
            $query->orderBy('created_at', 'desc');
        }
    }
}

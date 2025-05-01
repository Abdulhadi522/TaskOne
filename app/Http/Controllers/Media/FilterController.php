<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Services\FilterService;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    protected $filterService;
    public function __construct(FilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    public function Filter(Request $request)
    {
        return   $this->filterService->filter($request);
    }
}

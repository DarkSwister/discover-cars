<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Discovercars\LocationService;

class LocationController extends Controller
{
    public function __invoke(LocationService $carsService)
    {
        return response()->json($carsService->locations());
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetOffersRequest;
use App\Http\Resources\OfferResource;
use App\Models\Location;
use App\Services\Discovercars\DiscoverCarsService;
use App\Services\Discovercars\OfferService;

class OfferController extends Controller
{
    public function __invoke(Location $location, OfferService $carsService)
    {
        $offerCollection = $carsService->offers($location->id);
        return response()->json([
            'count' => $offerCollection->count(),
            'items' => $offerCollection
        ]);
    }
}

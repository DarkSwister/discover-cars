<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MakeReservationRequest;
use App\Services\Discovercars\DiscoverCarsService;

class ReservationController extends Controller
{
    public function __invoke(MakeReservationRequest $request, DiscoverCarsService $carsService)
    {
        $validated = $request->validated();
        dd($carsService->offers());
    }
}

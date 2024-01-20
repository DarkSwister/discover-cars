<?php

namespace App\Services\Discovercars;

use App\Http\Integrations\Discovercars\Resources\DiscoverCarsApiResource;
use App\Models\Booking;
use App\Services\Discovercars\DataTransferObjects\BookingRequestData;
use Illuminate\Support\Facades\Cache;

readonly class OfferService
{

    public function __construct(private DiscoverCarsApiResource $connector)
    {
    }

    public function offers(int $locationId): \Illuminate\Support\Collection
    {
        if (Cache::has('offers_' . $locationId)) {
            return Cache::get('offers_' . $locationId);
        }
        return Cache::remember('offers_' . $locationId, 60 * 5, fn() => $this->load($locationId));
    }

    public function load(int $locationId)
    {
        return $this->connector->offers($locationId);
    }

    public function book(BookingRequestData $data): Booking
    {
        $booking = $this->connector->createReservation($data);
        if ($booking->confirmationNumber) return $this->storeReservation($data, $booking->confirmationNumber);
        throw new \Exception('No confirmation number received from 3rd party API');
    }

    public function storeReservation(BookingRequestData $data, $confirmationNumber)
    {
        return Booking::create(['ip_address' => request()->getClientIp(), 'offerUId' => $data->offerUId, 'customer' => $data->customer->toArray(), 'confirmation_number' => $confirmationNumber]);
    }

}

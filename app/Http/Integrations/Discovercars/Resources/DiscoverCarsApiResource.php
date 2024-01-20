<?php
declare(strict_types=1);

namespace App\Http\Integrations\Discovercars\Resources;

use App\Enums\Method;
use App\Http\Integrations\Discovercars\DiscoverCarsConnector;
use App\Services\Discovercars\DataTransferObjects\BookingRequestData;
use App\Services\Discovercars\DataTransferObjects\CarOfferData;
use App\Services\Discovercars\DataTransferObjects\LocationData;
use Illuminate\Support\Collection;

final readonly class DiscoverCarsApiResource
{
    public function __construct(
        private DiscoverCarsConnector $connector,
    )
    {
    }

    public function locations(): Collection
    {
        return $this->connector->send(
            method: Method::GET,
            uri: config('services.discovercars.endpoints.locations'),
        )->collect()->map(fn(array $data) => LocationData::fromArray($data));
    }

    public function offers(int $locationId): Collection
    {
        return $this->connector->send(
            method: Method::GET,
            uri: config('services.discovercars.endpoints.offers') . '?LocationId=' . $locationId,
        )->collect()->map(fn(array $data) => CarOfferData::fromArray($data));
    }

    public function createReservation(BookingRequestData $data): ?object
    {
        return $this->connector->post(
            url: config('services.discovercars.endpoints.booking'),
            payload: [
                'offerUId' => $data->offerUId,
                'customer' => $data->customer,
            ]
        )->object();
    }

}

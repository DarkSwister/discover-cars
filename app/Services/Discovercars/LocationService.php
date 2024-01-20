<?php

namespace App\Services\Discovercars;

use App\Http\Integrations\Discovercars\Resources\DiscoverCarsApiResource;
use App\Models\Location;
use App\Services\Discovercars\DataTransferObjects\LocationData;
use Illuminate\Support\Facades\Cache;

readonly class LocationService
{

    public function __construct(private DiscoverCarsApiResource $connector)
    {
    }

    public function locations(): \Illuminate\Support\Collection
    {
        if (Cache::has('location')) {
            return Cache::get('locations');
        }
        if (empty(Location::count())) {
            $this->populate();
        }
        return Cache::remember('locations', 60 * 60, fn () => Location::get());
    }

    public function populate(): void
    {
        $this->connector->locations()->each(function (LocationData $location) {
            Location::create($location->toArray());
        });
    }

    public function sourceLocations(): \Illuminate\Support\Collection
    {
        return $this->connector->locations();
    }
}

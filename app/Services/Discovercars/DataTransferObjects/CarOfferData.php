<?php

namespace App\Services\Discovercars\DataTransferObjects;

use App\Services\Discovercars\ValueObjects\Price;
use App\Services\Discovercars\ValueObjects\Vehicle;
use App\Services\Discovercars\ValueObjects\Vendor;

readonly class CarOfferData
{
    public function __construct(
        public ?string  $offerUId,
        public ?Vehicle $vehicle,
        public ?Price   $price,
        public ?Vendor  $vendor,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            offerUId: $data['offerUId'] ?? null,
            vehicle: Vehicle::fromPayload($data['vehicle']),
            price: Price::fromPayload($data['price']),
            vendor: Vendor::fromPayload($data['vendor'])
        );
    }
}

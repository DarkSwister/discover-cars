<?php

namespace App\Services\Discovercars\DataTransferObjects;

use App\Services\Discovercars\ValueObjects\Customer;

readonly class BookingRequestData
{
    public function __construct(
        public ?string   $offerUId,
        public ?Customer $customer,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            offerUId: $data['offerUId'] ?? null,
            customer: new Customer(name: $data['name'], surname: $data['surname']),
        );
    }
}

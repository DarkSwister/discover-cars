<?php

namespace App\Services\Discovercars\DataTransferObjects;

readonly class LocationData
{
    public function __construct(
        public int     $id,
        public ?string $country,
        public ?string $city,
        public ?string $name,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            country: $data['country'] ?? null,
            city: $data['city'] ?? null,
            name: $data['name'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'country' => $this->country,
            'city' => $this->city,
            'name' => $this->name,
        ];
    }
}

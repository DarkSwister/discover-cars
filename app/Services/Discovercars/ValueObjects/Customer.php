<?php

namespace App\Services\Discovercars\ValueObjects;

readonly class Customer
{
    public function __construct(
        public string $name,
        public string $surname,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'surname' => $this->surname,
        ];
    }

    public static function fromPayload(array $data): Customer
    {
        return new self(
            name: $data['name'],
            surname: $data['surname'],
        );
    }
}

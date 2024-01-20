<?php

namespace App\Services\Discovercars\ValueObjects;

readonly class Vendor
{
    public function __construct(
        public ?string $name,
        public ?string $imageLink,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this?->name,
            'imageLink' => $this?->imageLink
        ];
    }
    public static function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'imageLink' => ['required', 'string','url'],
        ];
    }
    public static function fromPayload(array $data): Vendor
    {
        return new self(
            name: $data['name'],
            imageLink: $data['imageLink'],
        );
    }
}

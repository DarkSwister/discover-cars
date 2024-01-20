<?php

namespace App\Services\Discovercars\ValueObjects;

readonly class Vehicle
{
    public function __construct(
        public ?string $modelName,
        public ?string $sipp,
        public ?string $imageLink,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'modelName' => $this?->modelName,
            'sipp' => $this?->sipp,
            'imageLink' => $this?->imageLink
        ];
    }

    public static function rules(): array
    {
        return [
            'modelName' => ['required', 'string'],
            'sipp' => ['required', 'string'],
            'imageLink' => ['required', 'string','url'],
        ];
    }
    public static function fromPayload(array $data): Vehicle
    {
        return new self(
            modelName: $data['modelName'],
            sipp: $data['sipp'],
            imageLink: $data['imageLink'],
        );
    }
}

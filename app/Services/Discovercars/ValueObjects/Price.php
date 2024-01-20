<?php

namespace App\Services\Discovercars\ValueObjects;

readonly class Price
{
    public function __construct(
        public float  $amount,
        public string $currency,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'currency' => $this->currency,
        ];
    }

    public static function rules():array
    {
        return ['price'=> [
            'amount' => ['required','string'],
            'currency' => ['required','string'],
        ]];
    }

    public static function fromPayload(array $data): Price
    {
        return new self(
            amount: $data['amount'],
            currency: $data['currency'],
        );
    }
}

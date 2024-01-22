<?php
declare(strict_types=1);

namespace App\Http\Integrations\Discovercars;

use App\Enums\Method;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

final readonly class DiscoverCarsConnector
{
    public function __construct(
        private PendingRequest $request,
    )
    {
    }

    public function send(Method $method, string $uri, array $options = []): Response
    {
        return $this->request->send(
            method: $method->value,
            url: $uri,
            options: $options,
        )->throw();
    }

    public function post(string $url, array $payload = []): Response
    {
        return $this->request->post(
            url: $url,
            data: $payload,
        )->throw();
    }

}

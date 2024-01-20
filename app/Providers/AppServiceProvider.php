<?php

namespace App\Providers;

use App\Http\Integrations\Discovercars\DiscoverCarsConnector;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(
            abstract: DiscoverCarsConnector::class,
            concrete: fn() => new DiscoverCarsConnector(
                request: Http::baseUrl(
                    url: config('services.discovercars.url'),
                )->timeout(
                    seconds: 15,
                )->withHeaders(
                    headers: [
                        'Accept' => 'application/json',
                    ],
                )->asJson()->acceptJson(),
            ),
        );
    }
}

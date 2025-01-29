<?php

namespace App\Providers;

use App\Services\ContributionService;
use App\Services\IContributionService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $bindings = [
            IContributionService::class => ContributionService::class,
        ];

        foreach ($bindings as $interface => $service) {
            $this->app->bind($interface, $service);
        }
    }
}

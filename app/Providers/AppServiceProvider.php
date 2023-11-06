<?php

namespace App\Providers;

use App\Domain\Interfaces\Resolvers\TaxNumberCountryCodeResolver;
use App\Resolvers\RegexTaxNumberCountryCodeResolver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            TaxNumberCountryCodeResolver::class,
            RegexTaxNumberCountryCodeResolver::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

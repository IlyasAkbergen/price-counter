<?php

namespace App\Providers;

use App\Adapters\Presenters\Inertia\CalculateProductPriceInertiaPresenter;
use App\Adapters\Presenters\Json\CalculateProductPriceJsonPresenter;
use App\Domain\Interfaces\Country\CountryFactory;
use App\Domain\Interfaces\Country\CountryRepository;
use App\Domain\Interfaces\Product\ProductFactory;
use App\Domain\Interfaces\Product\ProductRepository;
use App\Domain\Interfaces\Resolvers\PurchasablePriceResolverInterface;
use App\Domain\Interfaces\Resolvers\TaxNumberCountryCodeResolver;
use App\Domain\UseCases\Product\CalculatePrice\CalculatePriceInputPort;
use App\Domain\UseCases\Product\CalculatePrice\CalculatePriceInteractor;
use App\Factories\Eloquent\EloquentCountryFactory;
use App\Factories\Eloquent\EloquentProductFactory;
use App\Repositories\Eloquent\CountryRepositoryEloquent;
use App\Repositories\Eloquent\ProductRepositoryEloquent;
use App\Resolvers\PurchasablePriceResolver;
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

        $this->app->bind(
            PurchasablePriceResolverInterface::class,
            PurchasablePriceResolver::class,
        );

        $this->app->bind(
            ProductFactory::class,
            EloquentProductFactory::class,
        );

        $this->app->bind(
            CountryFactory::class,
            EloquentCountryFactory::class,
        );

        $this->app->bind(
            ProductRepository::class,
            ProductRepositoryEloquent::class,
        );

        $this->app->bind(
            CountryRepository::class,
            CountryRepositoryEloquent::class,
        );

        $this->app->when(\App\Http\Controllers\Web\ProductController::class)
            ->needs(CalculatePriceInputPort::class)
            ->give(function($app) {
                return $app->make(CalculatePriceInteractor::class, [
                    'viewModelFactory' => $app->make(CalculateProductPriceInertiaPresenter::class),
                ]);
            });

        $this->app->when(\App\Http\Controllers\Api\ProductController::class)
            ->needs(CalculatePriceInputPort::class)
            ->give(function($app) {
                return $app->make(CalculatePriceInteractor::class, [
                    'viewModelFactory' => $app->make(CalculateProductPriceJsonPresenter::class),
                ]);
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

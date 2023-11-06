<?php

namespace Tests\Unit\UserCases;

use App\Adapters\Presenters\Json\CalculateProductPriceJsonPresenter;
use App\Domain\Interfaces\Country\CountryFactory;
use App\Domain\Interfaces\Country\CountryRepository;
use App\Domain\Interfaces\Product\ProductFactory;
use App\Domain\Interfaces\Product\ProductRepository;
use App\Domain\UseCases\Product\CalculatePrice\CalculatePriceInputPort;
use App\Domain\UseCases\Product\CalculatePrice\CalculatePriceRequestModel;
use App\Domain\UseCases\Product\CalculatePrice\CalculateProductPriceViewModelFactory;
use App\Repositories\Eloquent\CountryRepositoryEloquent;
use App\Repositories\Eloquent\ProductRepositoryEloquent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\MockObject\Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Tests\TestCase;
use Tests\Traits\ProvidesProducts;

class CalculateProductPriceUseCaseTest extends TestCase
{
    use RefreshDatabase;
    use ProvidesProducts;

    /**
     * @dataProvider productsDataProvider
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function testInteractor(
        ?array $product,
        ?array $country,
        string $taxNumber,
        ?float $price,
        ?string $errorMessage = null,
    ): void {
        /** @var ProductFactory $productFactory */
        $productFactory = $this->app->get(ProductFactory::class);
        /** @var CountryFactory $countryFactory */
        $countryFactory = $this->app->get(CountryFactory::class);
        $this->app->bind(
            CalculateProductPriceViewModelFactory::class,
            CalculateProductPriceJsonPresenter::class,
        );

        $product = $product
            ? $productFactory->make($product)
            : null;

        $requestModel = new CalculatePriceRequestModel([
            'product' => $product,
            'product_id' => 1,
            'tax_number' => $taxNumber,
        ]);

        $productRepositoryMock = $this->createMock(ProductRepositoryEloquent::class);
        $productRepositoryMock->method('getById')->with(1)->willReturn($product);
        $this->app->bind(
            ProductRepository::class,
            fn() => $productRepositoryMock,
        );

        $countryRepositoryMock = $this->createMock(CountryRepositoryEloquent::class);
        $countryRepositoryMock->method('getByCode')->withAnyParameters()->willReturn(
            $country ? $countryFactory->make($country) : null,
        );
        $this->app->bind(
            CountryRepository::class,
            fn() => $countryRepositoryMock,
        );

        /** @var CalculatePriceInputPort $interactor */
        $interactor = $this->app->get(CalculatePriceInputPort::class);
        $response = $interactor->calculatePrice($requestModel);

        if ($errorMessage) {
            $this->assertEquals(
                $errorMessage,
                $response->getResponse()['message'] ?? null,
            );
        } else {
            $this->assertProductMatches(
                $response->getResponse()['product'] ?? [],
                $product,
            );
            $this->assertEquals(
                $price,
                $response->getResponse()['price'] ?? null,
            );
        }
    }
}

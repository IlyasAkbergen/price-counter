<?php

namespace Tests\Unit\Resolvers;

use App\Domain\Interfaces\Country\CountryFactory;
use App\Domain\Interfaces\Product\ProductFactory;
use App\Domain\Interfaces\Resolvers\PurchasablePriceResolverInterface;
use App\Resolvers\PurchasablePriceResolver;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Tests\TestCase;

class PurchasablePriceResolverTest extends TestCase
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function test_app_gives_correct_instance(): void
    {
        $instance = $this->app->get(PurchasablePriceResolverInterface::class);

        $this->assertTrue($instance instanceof PurchasablePriceResolver);
    }

    /**
     * @dataProvider dataProvider
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function test_resolver_gives_correct_price(
        array $purchasableAttributes,
        array $countryAttributes,
        float $expectedPrice,
    ): void {
        /**
         * @var PurchasablePriceResolverInterface $instance
         */
        $instance = $this->app->get(PurchasablePriceResolverInterface::class);

        /**
         * @var ProductFactory $productFactory
         */
        $productFactory = $this->app->get(ProductFactory::class);

        /**
         * @var CountryFactory $countryFactory
         */
        $countryFactory = $this->app->get(CountryFactory::class);

        $purchasable = $productFactory->make($purchasableAttributes);
        $country = $countryFactory->make($countryAttributes);

        $this->assertEquals($expectedPrice, $instance->resolvePrice($purchasable, $country));
    }

    public static function dataProvider(): array
    {
        return [
            [
                'purchasable' => [
                    'name' => 'Name',
                    'price' => 100,
                ],
                'country' => [
                    'name' => 'Italy',
                    'vat_percent' => 22,
                ],
                'expectedPrice' => 122,
            ],
            [
                'purchasable' => [
                    'name' => 'Name',
                    'price' => 100,
                ],
                'country' => [
                    'name' => 'Greece',
                    'vat_percent' => 24,
                ],
                'expectedPrice' => 124,
            ],
            [
                'purchasable' => [
                    'name' => 'Name',
                    'price' => 100,
                ],
                'country' => [
                    'name' => 'Germany',
                    'vat_percent' => 19,
                ],
                'expectedPrice' => 119,
            ],
        ];
    }
}

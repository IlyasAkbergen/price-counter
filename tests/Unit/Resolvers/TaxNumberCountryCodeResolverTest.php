<?php

namespace Tests\Unit\Resolvers;

use App\Domain\Interfaces\Resolvers\TaxNumberCountryCodeResolver;
use App\Resolvers\RegexTaxNumberCountryCodeResolver;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Tests\TestCase;
use Tests\Traits\ProvidesTaxNumbers;

class TaxNumberCountryCodeResolverTest extends TestCase
{
    use ProvidesTaxNumbers;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function test_app_returns_regex_implementation(): void
    {
        $instance = $this->app->get(TaxNumberCountryCodeResolver::class);

        $this->assertTrue($instance instanceof RegexTaxNumberCountryCodeResolver);
    }

    /**
     * @dataProvider taxNumbersProvider
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function test_regex_implementation($taxNumber, $expected): void
    {
        /**
         * @var TaxNumberCountryCodeResolver $resolver
         */
        $resolver = $this->app->get(TaxNumberCountryCodeResolver::class);

        $this->assertEquals($expected, $resolver->resolveCountryCode($taxNumber));
    }
}

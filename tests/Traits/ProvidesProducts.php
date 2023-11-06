<?php

namespace Tests\Traits;

use App\Domain\Interfaces\Product\ProductEntity;

trait ProvidesProducts
{
    public static function productsDataProvider(): array
    {
        return [
            [
                'product' => [
                    'name' => 'Headphone',
                    'price' => 100,
                ],
                'country' => [
                    'code' => 'IT',
                    'name' => 'Italy',
                    'vat_percent' => 22,
                ],
                'taxNumber' => 'IT1234567890',
                'price' => 122,
            ],
            [
                'product' => [
                    'name' => 'Keyboard',
                    'price' => 150,
                ],
                'country' => [
                    'code' => 'GR',
                    'name' => 'Germany',
                    'vat_percent' => 19,
                ],
                'taxNumber' => 'GR123456789',
                'price' => 150 * 1.19,
            ],
            [
                'product' => null,
                'country' => [
                    'code' => 'GR',
                    'name' => 'Germany',
                    'vat_percent' => 19,
                ],
                'taxNumber' => 'GR123456789',
                'price' => 150 * 1.19,
                'errorMessage' => 'Product not found.',
            ],
            [
                'product' => [
                    'name' => 'Keyboard',
                    'price' => 150,
                ],
                'country' => null,
                'taxNumber' => 'GRB123456789',
                'price' => null,
                'errorMessage' => 'Could not resolve country code from tax number',
            ],
            [
                'product' => [
                    'name' => 'Keyboard',
                    'price' => 150,
                ],
                'country' => null,
                'taxNumber' => 'XX123456789',
                'price' => null,
                'errorMessage' => 'Could not find country with code XX',
            ],
        ];
    }

    public function assertProductMatches(array $data, ProductEntity $product): void
    {
        $this->assertEquals($data['name'] ?? null, $product->getName());
        $this->assertEquals($data['price'] ?? null, $product->getPrice());
    }
}

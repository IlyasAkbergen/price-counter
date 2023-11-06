<?php

namespace App\Domain\UseCases\Product\CalculatePrice;

use App\Domain\Interfaces\Product\ProductEntity;

class CalculatePriceRequestModel
{
    public function __construct(
        private readonly array $attributes,
    ) {
    }

    public function getProductId(): ?int
    {
        return $this->attributes['product_id'] ?? null;
    }

    public function getProduct(): ?ProductEntity
    {
        $product = $this->attributes['product'] ?? null;

        return $product instanceof ProductEntity
            ? $product
            : null;
    }

    public function getTaxNumber(): ?string
    {
        return $this->attributes['tax_number'] ?? null;
    }
}

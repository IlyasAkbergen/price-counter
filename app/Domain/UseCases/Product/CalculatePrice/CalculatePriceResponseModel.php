<?php

namespace App\Domain\UseCases\Product\CalculatePrice;

use App\Domain\Interfaces\Country\CountryEntity;
use App\Domain\Interfaces\Product\ProductEntity;

class CalculatePriceResponseModel
{
    public function __construct(
        private readonly ProductEntity $product,
        private readonly CountryEntity $country,
        private readonly float $price,
    ) {
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getProduct(): ProductEntity
    {
        return $this->product;
    }

    public function getCountry(): CountryEntity
    {
        return $this->country;
    }
}

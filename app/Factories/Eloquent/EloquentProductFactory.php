<?php

namespace App\Factories\Eloquent;

use App\Domain\Interfaces\Product\ProductEntity;
use App\Domain\Interfaces\Product\ProductFactory;
use App\Models\Product;

class EloquentProductFactory implements ProductFactory
{
    public function make(array $attributes = []): ProductEntity
    {
        return new Product($attributes);
    }
}

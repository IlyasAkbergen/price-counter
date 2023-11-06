<?php

namespace App\Domain\Interfaces\Product;

interface ProductFactory
{
    public function make(array $attributes = []): ProductEntity;
}

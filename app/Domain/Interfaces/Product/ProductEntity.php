<?php

namespace App\Domain\Interfaces\Product;

interface ProductEntity
{
    public function getName(): string;

    public function getPrice(): float;
}

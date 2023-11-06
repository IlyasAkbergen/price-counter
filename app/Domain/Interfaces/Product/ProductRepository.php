<?php

namespace App\Domain\Interfaces\Product;

interface ProductRepository
{
    public function getList(): array;
}

<?php

namespace App\Domain\Interfaces\Product;

use App\Domain\Interfaces\Purchasable;

interface ProductEntity extends Purchasable
{
    public function getName(): string;
}

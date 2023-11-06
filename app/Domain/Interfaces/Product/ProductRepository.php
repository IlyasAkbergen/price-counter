<?php

namespace App\Domain\Interfaces\Product;

interface ProductRepository
{
    public function getList(): array;

    public function getById(?int $id): ?ProductEntity;

    public function insertMany(ProductEntity ...$products): void;
}

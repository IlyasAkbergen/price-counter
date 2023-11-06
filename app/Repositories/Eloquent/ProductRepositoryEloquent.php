<?php

namespace App\Repositories\Eloquent;

use App\Domain\Interfaces\Product\ProductEntity;
use App\Domain\Interfaces\Product\ProductRepository;
use App\Models\Product;

class ProductRepositoryEloquent implements ProductRepository
{
    public function getList(): array
    {
        return Product::all()->toArray();
    }

    public function getById(?int $id): ?ProductEntity
    {
        /**
         * @var Product|null $product
         */
        $product = Product::query()->find($id);

        return $product;
    }

    public function insertMany(ProductEntity ...$products): void
    {
        Product::query()->insertOrIgnore(array_map(fn(ProductEntity $product) => [
            'name' => $product->getName(),
            'price' => $product->getPrice(),
        ], $products));
    }
}

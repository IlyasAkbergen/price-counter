<?php

namespace Database\Seeders;

use App\Domain\Interfaces\Country\CountryFactory;
use App\Domain\Interfaces\Country\CountryRepository;
use App\Domain\Interfaces\Product\ProductFactory;
use App\Domain\Interfaces\Product\ProductRepository;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function __construct(
        private readonly ProductFactory $productFactory,
        private readonly CountryFactory $countryFactory,
        private readonly ProductRepository $productRepository,
        private readonly CountryRepository $countryRepository,
    ) {
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $products = array_map(fn($productAttributes) => $this->productFactory->make($productAttributes), [
            [
                'name' => 'Mouse',
                'price' => 10,
            ],
            [
                'name' => 'Keyboard',
                'price' => 100,
            ],
            [
                'name' => 'Headphone',
                'price' => 10.90,
            ],
            [
                'name' => 'Logitech MX Master 3s For Mac',
                'price' => 101.85,
            ],
        ]);
        $this->productRepository->insertMany(...$products);

        $countries = array_map(fn($countryAttributes) => $this->countryFactory->make($countryAttributes), [
            [
                'name' => 'Germany',
                'code' => 'DE',
                'vat_percent' => 19,
            ],
            [
                'name' => 'Greece',
                'code' => 'GR',
                'vat_percent' => 24,
            ],
            [
                'name' => 'Italy',
                'code' => 'IT',
                'vat_percent' => 22,
            ],
        ]);
        $this->countryRepository->insertMany(...$countries);
    }
}

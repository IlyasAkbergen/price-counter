<?php

namespace App\Adapters\Presenters\Inertia;

use App\Adapters\ViewModels\InertiaViewModel;
use App\Domain\Interfaces\Product\ProductRepository;
use App\Domain\Interfaces\ViewModel;
use App\Domain\UseCases\Product\CalculatePrice\CalculatePriceResponseModel;
use App\Domain\UseCases\Product\CalculatePrice\CalculateProductPriceViewModelFactory;
use Inertia\Inertia;

class CalculateProductPriceInertiaPresenter implements CalculateProductPriceViewModelFactory
{
    public function __construct(
        private ProductRepository $productRepository,
    ) {
    }

    public function successResponse(CalculatePriceResponseModel $responseModel): ViewModel
    {
        return new InertiaViewModel(
            Inertia::render('Product/CalculateForm', [
                'products' => $this->productRepository->getList(),
                'product' => $responseModel->getProduct(),
                'price' => $responseModel->getPrice(),
                'country' => $responseModel->getCountry(),
            ]),
        );
    }

    public function productValueError(string $message): ViewModel
    {
        return new InertiaViewModel(
            Inertia::render('Product/CalculateForm', [
                'errors' => [
                    'product_id' => $message,
                ],
                'products' => $this->productRepository->getList(),
            ]),
        );
    }

    public function taxNumberValueError(string $message): ViewModel
    {
        return new InertiaViewModel(
            Inertia::render('Product/CalculateForm', [
                'errors' => [
                    'tax_number' => $message,
                ],
                'products' => $this->productRepository->getList(),
            ]),
        );
    }

    public function createFormResponse(): ViewModel
    {
        return new InertiaViewModel(
            Inertia::render('Product/CalculateForm', [
                'products' => $this->productRepository->getList(),
            ]),
        );
    }
}

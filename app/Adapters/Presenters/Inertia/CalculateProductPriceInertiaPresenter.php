<?php

namespace App\Adapters\Presenters\Inertia;

use App\Adapters\ViewModels\InertiaViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Domain\UseCases\Product\CalculatePrice\CalculatePriceResponseModel;
use App\Domain\UseCases\Product\CalculatePrice\CalculateProductPriceViewModelFactory;
use Inertia\Inertia;

class CalculateProductPriceInertiaPresenter implements CalculateProductPriceViewModelFactory
{
    public function successResponse(CalculatePriceResponseModel $responseModel): ViewModel
    {
        return new InertiaViewModel(
            Inertia::render('Product/Show', [
                'product' => $responseModel->getProduct(),
                'price' => $responseModel->getPrice(),
                'country' => $responseModel->getCountry(),
            ]),
        );
    }

    public function errorResponse(string $message): ViewModel
    {
        // TODO: Implement errorResponse() method.
    }
}

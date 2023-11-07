<?php

namespace App\Adapters\Presenters\Json;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Domain\UseCases\Product\CalculatePrice\CalculatePriceResponseModel;
use App\Domain\UseCases\Product\CalculatePrice\CalculateProductPriceViewModelFactory;
use App\Http\Resources\UnwrappedJsonResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CalculateProductPriceJsonPresenter implements CalculateProductPriceViewModelFactory
{
    public function successResponse(CalculatePriceResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(new JsonResource([
            'product' => [
                'name' => $responseModel->getProduct()->getName(),
                'price' => $responseModel->getProduct()->getPrice(),
            ],
            'price' => $responseModel->getPrice(),
        ]));
    }

    public function createFormResponse(): ViewModel
    {
        return new JsonResourceViewModel(new UnwrappedJsonResource([]));
    }

    public function productValueError(string $message): ViewModel
    {
        return new JsonResourceViewModel(new UnwrappedJsonResource([
            'errors' => [
                'product_id' => $message,
            ],
            'message' => $message,
        ]));
    }

    public function taxNumberValueError(string $message): ViewModel
    {
        return new JsonResourceViewModel(new UnwrappedJsonResource([
            'errors' => [
                'tax_number' => $message,
            ],
            'message' => $message,
        ]));
    }
}

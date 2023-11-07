<?php

namespace App\Domain\UseCases\Product\CalculatePrice;

use App\Domain\Interfaces\ViewModel;

interface CalculateProductPriceViewModelFactory
{
    public function createFormResponse(): ViewModel;

    public function successResponse(CalculatePriceResponseModel $responseModel): ViewModel;

    public function productValueError(string $message): ViewModel;

    public function taxNumberValueError(string $message): ViewModel;
}

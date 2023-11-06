<?php

namespace App\Domain\UseCases\Product\CalculatePrice;

use App\Domain\Interfaces\ViewModel;

interface CalculateProductPriceViewModelFactory
{
    public function successResponse(CalculatePriceResponseModel $responseModel): ViewModel;

    public function errorResponse(string $message): ViewModel;
}

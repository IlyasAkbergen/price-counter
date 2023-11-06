<?php

namespace App\Domain\UseCases\Product\CalculatePrice;

use App\Domain\Interfaces\ViewModel;

interface CalculatePriceInputPort
{
    public function calculatePrice(CalculatePriceRequestModel $requestModel): ViewModel;
}

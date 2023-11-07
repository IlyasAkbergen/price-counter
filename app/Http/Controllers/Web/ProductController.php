<?php

namespace App\Http\Controllers\Web;

use App\Domain\UseCases\Product\CalculatePrice\CalculatePriceInputPort;
use App\Domain\UseCases\Product\CalculatePrice\CalculatePriceRequestModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CalculatePriceRequest;
use Illuminate\Contracts\Support\Responsable;

class ProductController extends Controller
{
    public function __construct(
        private readonly CalculatePriceInputPort $calculatePriceInputPort,
    ) {
    }

    public function calculationForm(): Responsable
    {
        return $this->calculatePriceInputPort->getForm()->getResponse();
    }

    public function calculate(CalculatePriceRequest $request): Responsable
    {
        return $this->calculatePriceInputPort->calculatePrice(
            new CalculatePriceRequestModel($request->validated())
        )->getResponse();
    }
}

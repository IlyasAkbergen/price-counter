<?php

namespace App\Http\Controllers;

use App\Domain\Interfaces\Product\ProductRepository;
use App\Domain\UseCases\Product\CalculatePrice\CalculatePriceInputPort;
use App\Domain\UseCases\Product\CalculatePrice\CalculatePriceRequestModel;
use App\Http\Requests\Product\CalculatePriceRequest;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function __construct(
        private ProductRepository $productRepository,
        private CalculatePriceInputPort $calculatePriceInputPort,
    ) {
    }

    public function calculationForm(): Responsable
    {
        // todo refactor by clean arch
        return Inertia::render('Product/CalculateForm', [
            'products' => $this->productRepository->getList(),
        ]);
    }

    public function calculate(CalculatePriceRequest $request): Responsable
    {
        return $this->calculatePriceInputPort->calculatePrice(
            new CalculatePriceRequestModel($request->validated())
        )->getResponse();
    }
}

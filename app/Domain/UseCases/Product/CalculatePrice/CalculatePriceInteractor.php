<?php

namespace App\Domain\UseCases\Product\CalculatePrice;

use App\Domain\Interfaces\Country\CountryRepository;
use App\Domain\Interfaces\Product\ProductRepository;
use App\Domain\Interfaces\Resolvers\PurchasablePriceResolverInterface;
use App\Domain\Interfaces\Resolvers\TaxNumberCountryCodeResolver;
use App\Domain\Interfaces\ViewModel;

class CalculatePriceInteractor implements CalculatePriceInputPort
{
    public function __construct(
        private readonly CalculateProductPriceViewModelFactory $viewModelFactory,
        private readonly ProductRepository $productRepository,
        private readonly CountryRepository $countryRepository,
        private readonly TaxNumberCountryCodeResolver $countryCodeResolver,
        private readonly PurchasablePriceResolverInterface $purchasablePriceResolver,
    ) {
    }

    public function calculatePrice(CalculatePriceRequestModel $requestModel): ViewModel
    {
        if (!$product = $requestModel->getProduct()) {
            if (!$product = $this->productRepository->getById($requestModel->getProductId())) {
                return $this->viewModelFactory->errorResponse('Product not found.');
            }
        }

        if (!$countryCode = $this->countryCodeResolver->resolveCountryCode($requestModel->getTaxNumber())) {
            return $this->viewModelFactory->errorResponse('Could not resolve country code from tax number');
        }

        if (!$country = $this->countryRepository->getByCode($countryCode)) {
            return $this->viewModelFactory->errorResponse(
                sprintf('Could not find country with code %s', $countryCode),
            );
        }

        $price = $this->purchasablePriceResolver->resolvePrice($product, $country);

        return $this->viewModelFactory->successResponse(
            new CalculatePriceResponseModel(
                $product,
                $country,
                $price,
            ),
        );
    }
}

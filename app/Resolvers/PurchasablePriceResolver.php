<?php

namespace App\Resolvers;

use App\Domain\Interfaces\Country\CountryEntity;
use App\Domain\Interfaces\Purchasable;
use App\Domain\Interfaces\Resolvers\PurchasablePriceResolverInterface;

class PurchasablePriceResolver implements PurchasablePriceResolverInterface
{

    public function resolvePrice(Purchasable $purchasable, CountryEntity $country): float
    {
        return ($purchasable->getPrice() * (100 + $country->getVATPercent())) / 100;
    }
}

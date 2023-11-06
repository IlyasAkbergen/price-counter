<?php

namespace App\Domain\Interfaces\Resolvers;

use App\Domain\Interfaces\Country\CountryEntity;
use App\Domain\Interfaces\Purchasable;

interface PurchasablePriceResolverInterface
{
    public function resolvePrice(Purchasable $purchasable, CountryEntity $country): float;
}

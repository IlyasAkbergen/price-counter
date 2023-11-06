<?php

namespace App\Domain\Interfaces\Resolvers;

use App\Domain\Interfaces\Country\CountryEntity;

interface TaxNumberCountryCodeResolver
{
    public function resolveCountryCode(string $taxNumber): ?string;
}

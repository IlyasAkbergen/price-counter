<?php

namespace App\Resolvers;

use App\Domain\Interfaces\Resolvers\TaxNumberCountryCodeResolver;

class RegexTaxNumberCountryCodeResolver implements TaxNumberCountryCodeResolver
{
    public function resolveCountryCode(string $taxNumber): ?string
    {
        preg_match_all('/^([A-Z]{2})?[0-9]{9,10}/', $taxNumber, $matches);

        $countryCode = $matches[1][0] ?? null;

        if ($countryCode == '') {
            $countryCode = null;
        }

        return $countryCode;
    }
}

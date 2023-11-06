<?php

namespace App\Domain\Interfaces\Resolvers;

interface TaxNumberCountryCodeResolver
{
    public function resolveCountryCode(string $taxNumber): ?string;
}

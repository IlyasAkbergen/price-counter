<?php

namespace App\Domain\Interfaces\Country;

interface CountryRepository
{
    public function getByCode(string $countryCode): ?CountryEntity;
}

<?php

namespace App\Repositories\Eloquent;

use App\Domain\Interfaces\Country\CountryEntity;
use App\Domain\Interfaces\Country\CountryRepository;
use App\Models\Country;

class CountryRepositoryEloquent implements CountryRepository
{
    public function getByCode(string $countryCode): ?CountryEntity
    {
        /**
         * @var Country|null $country
         */
        $country = Country::query()->where('code', $countryCode)->first();

        return $country;
    }

    public function insertMany(CountryEntity ...$countries): void
    {
        Country::query()->insertOrIgnore(array_map(fn(CountryEntity $country) => [
            'name' => $country->getName(),
            'code' => $country->getCode(),
            'vat_percent' => $country->getVATPercent(),
        ], $countries));
    }
}

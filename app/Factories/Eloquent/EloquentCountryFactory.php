<?php

namespace App\Factories\Eloquent;

use App\Domain\Interfaces\Country\CountryEntity;
use App\Domain\Interfaces\Country\CountryFactory;
use App\Models\Country;

class EloquentCountryFactory implements CountryFactory
{
    public function make(array $attributes = []): CountryEntity
    {
        return new Country($attributes);
    }
}

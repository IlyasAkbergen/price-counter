<?php

namespace App\Domain\Interfaces\Country;

interface CountryFactory
{
    public function make(array $attributes = []): CountryEntity;
}

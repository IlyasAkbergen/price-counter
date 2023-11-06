<?php

namespace App\Domain\Interfaces\Country;

interface CountryEntity
{
    public function getVATPercent(): int;
}

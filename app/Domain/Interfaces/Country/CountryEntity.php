<?php

namespace App\Domain\Interfaces\Country;

interface CountryEntity
{
    public function getName(): string;

    public function getCode(): string;

    public function getVATPercent(): int;
}

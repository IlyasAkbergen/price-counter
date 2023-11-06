<?php

namespace App\Domain\Interfaces;

interface Purchasable
{
    public function getPrice(): float;
}

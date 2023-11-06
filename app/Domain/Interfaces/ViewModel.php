<?php

declare(strict_types=1);

namespace App\Domain\Interfaces;

use Illuminate\Contracts\Support\Responsable;

interface ViewModel
{
    public function getResponse(): Responsable;
}

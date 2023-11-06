<?php

namespace App\Adapters\ViewModels;

use App\Domain\Interfaces\ViewModel;
use Illuminate\Contracts\Support\Responsable;

class InertiaViewModel implements ViewModel
{
    public function getResponse(): Responsable
    {
    }
}

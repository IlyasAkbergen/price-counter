<?php

namespace App\Adapters\ViewModels;

use App\Domain\Interfaces\ViewModel;
use Illuminate\Contracts\Support\Responsable;
use Inertia\Response;

class InertiaViewModel implements ViewModel
{
    public function __construct(private Response $response)
    {
    }

    public function getResponse(): Responsable
    {
        return $this->response;
    }
}

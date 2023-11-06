<?php

namespace App\Models;

use App\Domain\Interfaces\Product\ProductEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements ProductEntity
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function getPrice(): float
    {
        return (float) $this->getAttribute('price');
    }
}

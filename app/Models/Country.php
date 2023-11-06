<?php

namespace App\Models;

use App\Domain\Interfaces\Country\CountryEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model implements CountryEntity
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'vat_percent',
    ];

    public function getName(): string
    {
        return (string) $this->getAttribute('name');
    }

    public function getCode(): string
    {
        return (string) $this->getAttribute('code');
    }

    public function getVATPercent(): int
    {
        return (int) $this->getAttribute('vat_percent');
    }
}

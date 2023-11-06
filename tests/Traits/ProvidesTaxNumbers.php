<?php

namespace Tests\Traits;

trait ProvidesTaxNumbers
{
    public static function taxNumbersProvider(): array
    {
        return [
            'DE success' => [
                'taxNumber' => 'DE123456789',
                'expected' => 'DE',
            ],
            'IT success' => [
                'taxNumber' => 'IT1234567890',
                'expected' => 'IT',
            ],
            'GR success' => [
                'taxNumber' => 'GR1234567890',
                'expected' => 'GR',
            ],
            [
                'taxNumber' => 'de1234567890',
                'expected' => null,
            ],
            [
                'taxNumber' => 'DEC1234567890',
                'expected' => null,
            ],
            [
                'taxNumber' => '1234567890',
                'expected' => null,
            ],
            [
                'taxNumber' => 'de123',
                'expected' => null,
            ],
        ];
    }
}

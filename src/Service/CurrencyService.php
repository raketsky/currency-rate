<?php
namespace App\Service;

class CurrencyService
{
    public function getLatest(): array
    {
        return [
            ['name' => 'AUD', 'price' => 1.75960000],
            ['name' => 'BGN', 'price' => 1.95580000],
            ['name' => 'BRL', 'price' => 5.67410000],
        ];
    }

    public function getHistoryByName(string $name, int $count = 10): array
    {
        return [
            ['date' => '2019-01-03', 'price' => 1.75960000],
            ['date' => '2019-01-02', 'price' => 1.74960000],
            ['date' => '2019-01-01', 'price' => 1.76960000],
        ];
    }
}

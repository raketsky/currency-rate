<?php
namespace App\Service;

use App\Bank\DataParser;

class BankService
{
    public function getData(): array
    {
        $dataParser = new DataParser();

        return $dataParser->fromString($this->getRawDataFromServer());
    }

    protected function getRawDataFromServer(): string
    {
        return file_get_contents('https://www.bank.lv/vk/ecb_rss.xml');
    }
}

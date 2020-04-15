<?php
namespace App\Bank;

use DateTime;

class DataParser
{
    /**
     * @param string $rawData
     * @return array
     */
    public function fromString(string $rawData): array
    {
        $rawData = simplexml_load_string($rawData);
        $data = [];
        foreach ($rawData->channel->item as $item) {
            $data[] = [
                'date' => $this->parseDateFromTitle($item->title),
                'items' => $this->parseItemsFromDescription($item->description),
            ];
        }

        return $data;
    }

    private function parseDateFromTitle(string $title): string
    {
        $re = '/[0-9]+. [A-Za-z]+/m';
        preg_match_all($re, $title, $matches, PREG_SET_ORDER, 0);
        $date = DateTime::createFromFormat('j. F', $matches[0][0]);

        return $date->format('Y-m-d');
    }

    private function parseItemsFromDescription(string $description): array
    {
        $re = '/[A-Z]+ [0-9]+.[0-9]+/m';
        preg_match_all($re, $description, $matches, PREG_SET_ORDER, 0);

        $items = [];
        foreach ($matches as $match) {
            list($currency, $price) = explode(' ', end($match));
            $items[strtolower($currency)] = $price;
        }

        return $items;
    }
}

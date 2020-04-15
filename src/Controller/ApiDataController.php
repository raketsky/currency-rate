<?php
namespace App\Controller;

use App\Repository\CurrencyRateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiDataController extends AbstractController
{
    public function getByName(Request $request, CurrencyRateRepository $currencyRateRepository)
    {
        $response = [];
        $items = $currencyRateRepository->findByName($request->get('name'));
        foreach ($items as $item) {
            $response[] = [
                $item->getDate()->getTimestamp() * 1000,
                $item->getPrice()
            ];
        }

        return new JsonResponse($response);
    }
}

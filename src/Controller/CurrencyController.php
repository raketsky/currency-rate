<?php
namespace App\Controller;

use App\Service\CurrencyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CurrencyController extends AbstractController
{
    public function latest(CurrencyService $currencyService)
    {
        return $this->render('currency/latest.twig', [
            'currencies' => $currencyService->getLatest(),
        ]);
    }

    public function item(Request $request, CurrencyService $currencyService)
    {
        $name = $request->get('name');
        $currencyData = $currencyService->getHistoryByName($name);

        return $this->render('currency/item.twig', [
            'name' => $name,
            'history' => $currencyData,
        ]);
    }
}
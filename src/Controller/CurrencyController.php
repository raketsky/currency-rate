<?php
namespace App\Controller;

use App\Exception\AppException;
use App\Service\CurrencyService;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CurrencyController extends AbstractController
{
    /**
     * @param CurrencyService $currencyService
     * @return Response
     * @throws AppException
     * @throws NonUniqueResultException
     */
    public function latest(CurrencyService $currencyService): Response
    {
        return $this->render('currency/latest.twig', [
            'currencies' => $currencyService->getLatest(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function item(Request $request): Response
    {
        $name = $request->get('name');

        return $this->render('currency/item.twig', [
            'name' => $name,
        ]);
    }
}

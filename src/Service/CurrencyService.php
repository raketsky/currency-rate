<?php
namespace App\Service;

use App\Entity\CurrencyRate;
use App\Exception\AppException;
use App\Repository\CurrencyRateRepository;
use DateTimeInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class CurrencyService
{
    private $currencyRateRepository;

    public function __construct(CurrencyRateRepository $currencyRateRepository)
    {
        $this->currencyRateRepository = $currencyRateRepository;
    }

    /**
     * @return array|CurrencyRate[]
     * @throws AppException
     * @throws NonUniqueResultException
     */
    public function getLatest(): array
    {
        $latestDate = $this->findLatestDate();
        if (!$latestDate) {
            throw new AppException('No currency records found', 404);
        }

        return $this->currencyRateRepository->findByDate($latestDate);
    }

    /**
     * @return DateTimeInterface
     * @throws NonUniqueResultException
     */
    public function findLatestDate(): ?DateTimeInterface
    {
        $latestItem = $this->currencyRateRepository->findOneLatest();

        return $latestItem ? $latestItem->getDate() : null;
    }

    /**
     * @param string            $name
     * @param float             $price
     * @param DateTimeInterface $date
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addByDate(string $name, float $price, DateTimeInterface $date): void
    {
        $currency = $this->currencyRateRepository->findOneByNameAndDate($name, $date);
        if (!$currency) {
            $this->currencyRateRepository->addNewByNameAndDate($name, $price, $date);
        }
    }

    /**
     * @param DateTimeInterface $date
     * @param array             $items
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addByDateBatch(DateTimeInterface $date, array $items): void
    {
        foreach ($items as $name => $price) {
            $this->addByDate($name, $price, $date);
        }
    }
}

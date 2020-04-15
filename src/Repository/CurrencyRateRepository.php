<?php
namespace App\Repository;

use App\Entity\CurrencyRate;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CurrencyRate|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrencyRate|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrencyRate[]    findAll()
 * @method CurrencyRate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyRateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrencyRate::class);
    }

    /**
     * @param string            $name
     * @param float             $price
     * @param DateTimeInterface $date
     * @return CurrencyRate
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addNewByNameAndDate(string $name, float $price, DateTimeInterface $date): CurrencyRate
    {
        $entityManager = $this->getEntityManager();

        $product = new CurrencyRate();
        $product->setName($name);
        $product->setPrice($price);
        $product->setDate($date);

        $entityManager->persist($product);
        $entityManager->flush();

        return $product;
    }

    /**
     * @param string            $name
     * @param DateTimeInterface $date
     * @return CurrencyRate|null
     */
    public function findOneByNameAndDate(string $name, DateTimeInterface $date): ?CurrencyRate
    {
        return $this->findOneBy([
            'name' => $name,
            'date' => $date
        ]);
    }

    /**
     * @return CurrencyRate|null
     * @throws NonUniqueResultException
     */
    public function findOneLatest(): ?CurrencyRate
    {
        return $this->createQueryBuilder('c')
            ->setMaxResults(1)
            ->orderBy('c.date', 'DESC')
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param DateTimeInterface $date
     * @return CurrencyRate[]
     */
    public function findByDate(DateTimeInterface $date)
    {
        return $this->findBy(['date' => $date]);
    }

    /**
     * @param string $name
     * @param int    $limit
     * @return CurrencyRate[]
     */
    public function findByName(string $name, int $limit = 90): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name = :name')
            ->setParameter('name', $name)
            ->setMaxResults($limit)
            ->orderBy('c.date', 'DESC')
            ->getQuery()
            ->getResult();
    }
}

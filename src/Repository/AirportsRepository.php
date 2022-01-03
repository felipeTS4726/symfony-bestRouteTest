<?php

namespace App\Repository;

use App\Entity\Airports;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Airports|null find($id, $lockMode = null, $lockVersion = null)
 * @method Airports|null findOneBy(array $criteria, array $orderBy = null)
 * @method Airports[]    findAll()
 * @method Airports[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirportsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Airports::class);
    }

    /**
     * @return Airports[] Returns an array of Airports objects
    */

    public function findByCity($cityId)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.cityId = :val')
            ->setParameter('val', $cityId)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

	/**
	 * @return Airports[] Returns an array of Airports objects
	 */

	public function findByCountry($coutryId)
	{
		return $this->createQueryBuilder('a')
            ->andWhere('a.countryId = :val')
            ->setParameter('val', $coutryId)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
	}
}

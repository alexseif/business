<?php

namespace App\Repository;

use App\Entity\TimeManagement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TimeManagement>
 *
 * @method TimeManagement|null find($id, $lockMode = null, $lockVersion = null)
 * @method TimeManagement|null findOneBy(array $criteria, array $orderBy = null)
 * @method TimeManagement[]    findAll()
 * @method TimeManagement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimeManagementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TimeManagement::class);
    }

    public function save(TimeManagement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TimeManagement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByNotCompletedOrCompletedToday(){
        return $this->createQueryBuilder('time_management')
        ->where('time_management.completed is NULL OR time_management.completed >= CURRENT_DATE()')
            ->orderBy('time_management.completed')
        ->getQuery()
        ->getResult();
    }

}

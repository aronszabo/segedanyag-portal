<?php

namespace App\Repository;

use App\Entity\Subject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Subject|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subject|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subject[]    findAll()
 * @method Subject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubjectRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Subject::class);
    }

    public function findOneBySlugs($trtype, $trslug, $slug): ?Subject
    {

        return $this->createQueryBuilder('s')
            ->leftJoin('s.training', 't')
            ->andWhere('s.slug = :slug')
            ->andWhere('t.slug = :trslug')
            ->andWhere('t.'.TrainingRepository::validateType($trtype).' = true')
            ->setParameter('slug', $slug)
            ->setParameter('trslug', $trslug)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    // /**
    //  * @return Subject[] Returns an array of Subject objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Subject
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

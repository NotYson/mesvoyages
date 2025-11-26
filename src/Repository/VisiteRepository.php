<?php

namespace App\Repository;

use App\Entity\Visite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Visite>
 */
class VisiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visite::class);
    }

    //    /**
    //     * @return Visite[] Returns an array of Visite objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('v.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Visite
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    /**
     * Retourne toutes les visites triées sur un champ donné
     *
     * @param string $champ  Nom du champ (ex : 'datecreation', 'ville', 'pays', 'note')
     * @param string $ordre  'ASC' ou 'DESC'
     * @return Visite[]
     */
    public function findAllOrderBy($champ, $ordre): array
    {
        return $this->createQueryBuilder('v')
            ->orderBy('v.' . $champ, $ordre)
            ->getQuery()
            ->getResult();
    }

    public function findByEqualValue(string $champ, string $valeur): array
    {
        if ($valeur === "") {
            return $this->createQueryBuilder('v')
                ->orderBy('v.' . $champ, 'ASC')
                ->getQuery()
                ->getResult();
        } else {
            return $this->createQueryBuilder('v')
                ->where('v.' . $champ . ' = :valeur')
                ->setParameter('valeur', $valeur)
                ->orderBy('v.datecreation', 'DESC')
                ->getQuery()
                ->getResult();
        }
    }

    public function remove(Visite $visite): void
    {
        $this->getEntityManager()->remove($visite);
        $this->getEntityManager()->flush();
    }

    public function add(Visite $visite): void
    {
        $this->getEntityManager()->persist($visite);
        $this->getEntityManager()->flush();
    }
}

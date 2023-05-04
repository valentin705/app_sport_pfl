<?php

namespace App\Repository;

use App\Entity\Seance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Seance>
 *
 * @method Seance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seance[]    findAll()
 * @method Seance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seance::class);
    }

    public function save(Seance $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Seance $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByName(string $query)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->where(
                $qb->expr()->andX(
                    $qb->expr()->orX(
                        $qb->expr()->like('p.name', ':query'),
                        // $qb->expr()->like('p.description', ':query'),
                    ),
                )
            )
            ->setParameter('query', '%' . $query . '%')
            ->orderBy('p.createdAt', 'DESC');
        return $qb
            ->getQuery()
            ->getResult();
    }

    public function createdOrderByLikesQueryBuilder()
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->leftJoin('p.likes', 'l') // Jointure avec la relation likes
            ->groupBy('p.id') // Groupement par l'ID de la séance
            ->orderBy('COUNT(l.id)', 'DESC') // Tri par le nombre de likes (le COUNT() de l'ID des likes)
            ->setMaxResults(3);

        return $qb
            ->getQuery()
            ->getResult();
    }

    // filtre par catégorie avec un slug
    public function findByCategory($category)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->leftJoin('p.categories', 'c')
            ->where('c.name = :category')
            ->setParameter('category', $category)
            ->orderBy('p.createdAt', 'DESC');

        return $qb
            ->getQuery()
            ->getResult();
    }

    public function findSeancesOrderedByIdDesc()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByUser($user)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->leftJoin('p.user', 'u')
            ->where('u.id = :user')
            ->setParameter('user', $user)
            ->orderBy('p.createdAt', 'DESC');

        return $qb
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Seance[] Returns an array of Seance objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Seance
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

<?php

namespace App\Repository;

use App\Entity\CategoryBlog;
use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function findByCategory(){

        return $this->createQueryBuilder('u')
            ->select('c.id, c.title AS category, p.title AS post')
            ->from('App\Entity\Post', 'p')
            ->leftJoin('App\Entity\CategoryBlog', 'c', Join::WITH, 'p.category = c.id')
            ->getQuery()
            ->getResult();
    }
}

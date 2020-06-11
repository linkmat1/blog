<?php

namespace App\Repository;

use App\Entity\CategoryBlog;
use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoryBlog|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryBlog|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryBlog[]    findAll()
 * @method CategoryBlog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryBlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryBlog::class);
    }



}

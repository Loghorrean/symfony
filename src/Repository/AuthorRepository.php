<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository implements AuthorRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }
    
    public function getAllAuthors(): array
    {
        // TODO: Implement getAllAuthors() method.
    }

    public function getOneAuthor(): Author
    {
        // TODO: Implement getOneAuthor() method.
    }

    public function setCreateAuthor(Author $author): Author
    {
        // TODO: Implement setCreateAuthor() method.
    }
}

<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository implements AuthorRepositoryInterface
{
    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager) {
        parent::__construct($registry, Author::class);
        $this->manager = $manager;
    }
    
    public function getAllAuthors(): array {
        return parent::findAll();
    }

    public function getOneAuthor(int $id): Author {
        return parent::find($id);
    }

    public function setCreateAuthor(Author $author): Author {
        $this->manager->persist($author);
        $this->manager->flush();
        return $author;
    }
}

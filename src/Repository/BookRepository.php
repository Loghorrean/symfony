<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository as parentAlias;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends parentAlias implements BookRepositoryInterface
{
    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager) {
        $this->manager = $manager;
        parent::__construct($registry, Book::class);
    }

    public function getAllBooks(): array {
        return parent::findAll();
    }

    public function getOneBook(int $id): Book {
        return parent::find($id);
    }

    public function setCreateBook(Book $book): Book {
        $this->manager->persist($book);
        $this->manager->flush();
        return $book;
    }

    public function setUpdateBook(Book $book): Book {
        $this->manager->flush();
        return $book;
    }

    public function setDeleteBook(Book $book): void {
        $this->manager->remove($book);
        $this->manager->flush();
    }
}
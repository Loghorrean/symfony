<?php


namespace App\Repository;


use App\Entity\Book;

interface BookRepositoryInterface {
    /**
     * @return Book[]
     */
    public function getAllBooks() : array;

    /**
     * @param int $id
     * @return Book
     */
    public function getOneBook(int $id) : Book;

    /**
     * @param Book $book
     * @return Book
     */
    public function setCreateBook(Book $book) : Book;

    /**
     * @param Book $book
     * @return Book
     */
    public function setUpdateBook(Book $book) : Book;

    /**
     * @param Book $book
     */
    public function setDeleteBook(Book $book) : void;
}
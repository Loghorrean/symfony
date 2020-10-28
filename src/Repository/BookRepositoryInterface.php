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
    public function getOneBook(int $id) : object;

    /**
     * @param Book $book
     * @return Book
     */
    public function setCreateBook(Book $book) : object;

    /**
     * @param Book $book
     * @return Book
     */
    public function setUpdateBook(Book $book) : object;

    /**
     * @param Book $book
     */
    public function setDeleteBook(Book $book) : void;
}
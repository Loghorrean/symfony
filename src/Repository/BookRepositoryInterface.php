<?php


namespace App\Repository;


use App\Entity\Book;

interface BookRepositoryInterface {
    /**
     * @return Book[]
     */
    public function getAllBooks() : array;

    /**
     * @return Book
     */
    public function getOneBook() : Book;

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
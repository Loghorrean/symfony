<?php


namespace App\Repository;


use App\Entity\Author;

interface AuthorRepositoryInterface {
    /**
     * @return Author[]
     */
    public function getAllAuthors() : array;

    /**
     * @param int $id
     * @return Author
     */
    public function getOneAuthor(int $id) : object;

    /**
     * @param Author $author
     * @return Author
     */
    public function setCreateAuthor(Author $author) : object;
}
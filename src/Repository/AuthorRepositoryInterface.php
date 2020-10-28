<?php


namespace App\Repository;


use App\Entity\Author;

interface AuthorRepositoryInterface {
    /**
     * @return Author[]
     */
    public function getAllAuthors() : array;

    /**
     * @return Author
     */
    public function getOneAuthor() : Author;

    /**
     * @param Author $author
     * @return Author
     */
    public function setCreateAuthor(Author $author) : Author;
}
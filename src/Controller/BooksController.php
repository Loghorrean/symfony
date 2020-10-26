<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooksController
{
    /**
     * @Route("/")
     */
    public function index() {
        return new Response("Test controller");
    }

    /**
     * @Route("/add")
     */
    public function add_book() {
        return new Response("Method to add a book");
    }

    /**
     * @Route("/edit/{book_id}")
     */
    public function edit_book($book_id) {
        return new Response(sprintf("Method to edit a book with the id = %s",
            $book_id));
    }
}
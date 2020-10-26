<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooksController
{
    /**
     * @Route("/")
     */
    public function index() : Response {
        return new Response("Test controller");
    }

    /**
     * @Route("/add")
     */
    public function add_book() : Response {
        return new Response("Method to add a book");
    }

    /**
     * @Route("/edit/{book_id}")
     * @param int $book_id
     * @return Response
     */
    public function edit_book(int $book_id) : Response {
        return new Response(sprintf("Method to edit a book with the id = %s",
            $book_id));
    }
}
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    /**
     * @Route("/", name="main_page")
     */
    public function index() : Response {
        return $this->render('Books/book_main.html.twig');
    }

    /**
     * @Route("/add", name="add_a_book")
     */
    public function add_book() : Response {
        return $this->render('Books/book_add.html.twig');
    }

    /**
     * @Route("/edit/{book_id<\d+>}", name="edit_a_book")
     * @param int $book_id
     * @return Response
     */
    public function edit_book(int $book_id) : Response {
        return $this->render('Books/book_edit.html.twig', ['book_id' => $book_id]);
    }

    /**
     * @Route("/authors", name="add_an_author");
     * @return Response
     */
    public function add_author() : Response {
        return $this->render('Author/author_add.html.twig');
    }
}
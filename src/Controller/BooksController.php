<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Form\AuthorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    /**
     * @Route("/", name="main_page")
     */
    public function index() : Response {
        $books = $this->getDoctrine()->getRepository(Book::class)->getBooksWithAuthors();
        return $this->render('Books/book_main.html.twig', ['books' => $books]);
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
        $book = $this->getDoctrine()->getRepository(Author::class)->find($book_id);
        if (!$book) {
            throw $this->createNotFoundException("No book with an id " . $book_id);
        }
        return $this->render('Books/book_edit.html.twig', ['book_id' => $book->getId(), 'author_name' => $book->getName()]);
    }

    /**
     * @Route("/authors", name="add_an_author");
     * @param Request $request
     * @return Response
     */
    public function add_author(Request $request) : Response {
        $author = new Author();
        $em = $this->getDoctrine()->getManager();

        $authors = $this->getDoctrine()->getRepository(Author::class)->findAll();
        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $author = $form->getData();
            $em->persist($author);
            $em->flush();
            return $this->redirectToRoute('main_page');
        }
        return $this->render('Author/author_add.html.twig', ['authors' => $authors, 'form' => $form->createView()]);
    }
}
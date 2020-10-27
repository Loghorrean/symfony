<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Form\AuthorType;
use App\Form\BookType;
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
        $books = $this->getDoctrine()->getRepository(Book::class)->findAll();
        return $this->render('Books/book_main.html.twig', ['books' => $books]);
    }

    /**
     * @Route("/add_book", name="add_a_book")
     */
    public function add_book(Request $request) : Response {
        $book = new Book();
        $em = $this->getDoctrine()->getManager();

        $books = $this->getDoctrine()->getRepository(Book::class)->findAll();

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($book);
            $em->flush();
            $this->addFlash('add_book_success', 'Book is successfully added');
            return $this->redirectToRoute('add_a_book');
        }
        return $this->render('Books/book_add.html.twig', ['books' => $books, 'form' => $form->createView()]);
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
            $this->addFlash('add_author_success', 'Author is successfully added');
            return $this->redirectToRoute('add_an_author');
        }
        return $this->render('Author/author_add.html.twig', ['authors' => $authors, 'form' => $form->createView()]);
    }

    /**
     * @Route("/edit_book/{book_id<\d+>}", name="edit_a_book")
     * @param int $book_id
     * @param Request $request
     * @return Response
     */
    public function edit_book(int $book_id, Request $request) : Response {
        $em = $this->getDoctrine()->getManager();

        $book = $this->getDoctrine()->getRepository(Book::class)->find($book_id);
        if (!$book) {
            throw $this->createNotFoundException("No book with an id " . $book_id);
        }

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('save')->isClicked()) {
                $this->addFlash('edit_book_success', 'Book is successfully edited');
            }
            if ($form->get('delete')->isClicked()) {
                $em->remove($book);
            }
            $em->flush();
            return $this->redirectToRoute('main_page');
        }
        return $this->render('Books/book_edit.html.twig', ['form' => $form->createView()]);
    }
}
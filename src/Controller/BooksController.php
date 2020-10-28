<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Form\AuthorType;
use App\Form\BookType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends BaseController
{
    /**
     * @Route("/", name="main_page")
     */
    public function index() : Response {
        $defaultRender = parent::renderDefault();
        $books = $this->getDoctrine()->getRepository(Book::class)->findAll();
        $defaultRender['books'] = $books;
        $defaultRender['title'] = "Main Page";
        return $this->render('Books/book_main.html.twig', $defaultRender);
    }

    /**
     * @Route("/add_book", name="add_a_book")
     */
    public function add_book(Request $request) : Response {
        $defaultRender = parent::renderDefault();
        $book = new Book();
        $em = $this->getDoctrine()->getManager();

        $books = $this->getDoctrine()->getRepository(Book::class)->findAll();
        $authors = $this->getDoctrine()->getRepository(Author::class)->findAll();

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($book);
            $em->flush();
            $this->addFlash('add_book_success', 'Book is successfully added');
            return $this->redirectToRoute('add_a_book');
        }
        $defaultRender['title'] = "Add a book!";
        $defaultRender['form'] = $form->createView();
        $defaultRender['books'] = $books;
        $defaultRender['check_authors'] = $authors;
        return $this->render('Books/book_add.html.twig', $defaultRender);
    }

    /**
     * @Route("/authors", name="add_an_author");
     * @param Request $request
     * @return Response
     */
    public function add_author(Request $request) : Response {
        $defaultRender = parent::renderDefault();
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
        $defaultRender['title'] = "Add new Author!";
        $defaultRender['form'] = $form->createView();
        $defaultRender['authors'] = $authors;
        return $this->render('Author/author_add.html.twig', $defaultRender);
    }

    /**
     * @Route("/edit_book/{book_id<\d+>}", name="edit_a_book")
     * @param int $book_id
     * @param Request $request
     * @return Response
     */
    public function edit_book(int $book_id, Request $request) : Response {
        $defaultRender = parent::renderDefault();
        $em = $this->getDoctrine()->getManager();

        $book = $this->getDoctrine()->getRepository(Book::class)->find($book_id);
        if (!$book) {
            throw $this->createNotFoundException("No book with an id " . $book_id);
        }

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('edit_book_success', 'Book number ' . $book->getId() . ' is successfully edited');
            $em->flush();
            return $this->redirectToRoute('main_page');
        }
        $defaultRender['title'] = 'Edit a book';
        $defaultRender['form'] = $form->createView();
        return $this->render('Books/book_edit.html.twig', $defaultRender);
    }

    /**
     * @Route("/delete_book/{book_id<\d+>}", name="delete_a_book")
     * @param int $book_id
     * @param Request $request
     * @return Response
     */
    public function delete_book(int $book_id, Request $request) : Response {
        $em = $this->getDoctrine()->getManager();

        $book = $this->getDoctrine()->getRepository(Book::class)->find($book_id);
        if (!$book) {
            throw $this->createNotFoundException("No book with an id " . $book_id);
        }
        $em->remove($book);
        $em->flush();
        $this->addFlash('delete_book_success', 'Book with the title ' . $book->getName() . ' is successfully deleted');
        return $this->redirectToRoute('main_page');
    }
}
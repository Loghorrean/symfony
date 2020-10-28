<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Form\AuthorType;
use App\Form\BookType;
use App\Repository\AuthorRepositoryInterface;
use App\Repository\BookRepositoryInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends BaseController
{
    private $booksRepository;
    private $authorsRepository;

    public function __construct(BookRepositoryInterface $booksRepository, AuthorRepositoryInterface $authorsRepository) {
        $this->booksRepository = $booksRepository;
        $this->authorsRepository = $authorsRepository;
    }

    /**
     * @Route("/", name="main_page")
     * @return Response
     */
    public function index() : Response {
        $defaultRender = parent::renderDefault();
        $defaultRender['books'] = $this->booksRepository->getAllBooks();
        $defaultRender['title'] = "Main Page";
        return $this->render('Books/book_main.html.twig', $defaultRender);
    }

    /**
     * @Route("/add_book", name="add_a_book")
     * @param Request $request
     * @return Response
     */
    public function add_book(Request $request) : Response {
        $defaultRender = parent::renderDefault();
        $book = new Book();

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->booksRepository->setCreateBook($book);
            $this->addFlash('add_book_success', 'Book is successfully added');
            return $this->redirectToRoute('add_a_book');
        }
        $defaultRender['title'] = "Add a book!";
        $defaultRender['form'] = $form->createView();
        $defaultRender['books'] = $this->booksRepository->getAllBooks();
        $defaultRender['check_authors'] = $this->authorsRepository->getAllAuthors();
        return $this->render('Books/book_add.html.twig', $defaultRender);
    }

    /**
     * @Route("/edit_book/{book_id<\d+>}", name="edit_a_book")
     * @param int $book_id
     * @param Request $request
     * @return Response
     */
    public function edit_book(int $book_id, Request $request) : Response {
        $defaultRender = parent::renderDefault();

        $book = $this->booksRepository->getOneBook($book_id);
        if (!$book) {
            throw $this->createNotFoundException("No book with an id " . $book_id);
        }

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->booksRepository->setUpdateBook($book);
            $this->addFlash('edit_book_success', 'Book number ' . $book->getId() . ' is successfully edited');
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

        $book = $this->booksRepository->getOneBook($book_id);
        if (!$book) {
            throw $this->createNotFoundException("No book with an id " . $book_id);
        }
        $this->booksRepository->setDeleteBook($book);
        $this->addFlash('delete_book_success', 'Book with the title ' . $book->getName() . ' is successfully deleted');
        return $this->redirectToRoute('main_page');
    }
}
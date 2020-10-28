<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends BaseController {
    private $authorsRepository;

    public function __construct(AuthorRepositoryInterface $authorsRepository) {
        $this->authorsRepository = $authorsRepository;
    }

    /**
     * @Route("/authors", name="add_an_author");
     * @param Request $request
     * @return Response
     */
    public function add_author(Request $request) : Response {
        $defaultRender = parent::renderDefault();
        $author = new Author();

        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->authorsRepository->setCreateAuthor($author);
            $this->addFlash('add_author_success', 'Author is successfully added');
            return $this->redirectToRoute('add_an_author');
        }
        $defaultRender['title'] = "Add new Author!";
        $defaultRender['form'] = $form->createView();
        $defaultRender['authors'] = $this->authorsRepository->getAllAuthors();
        return $this->render('Author/author_add.html.twig', $defaultRender);
    }
}
<?php


namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminBookController extends AbstractController
{
	/**
	 * @Route("/admin/books/form_insert", name="books_form_insert")
	 */
	public function bookFormInsert(Request $request, EntityManagerInterface $entityManager)
	{
		// Utilisation du fichier BookType pour créer le formulaire
		// (ne contient pas encore de html)

		$book = new Book();

		$form = $this->createForm(BookType::class, $book);
		// création de la view du formulaire
		$formBookView = $form->createView();


		// Si la méthode est POST
		// si le formulaire est envoyé
		if ($request->isMethod('Post')) {

			// Le formulaire récupère les infos
			// de la requête
			$form->handleRequest($request);

			// on vérifie que le formulaire est valide
			if ($form->isValid()) {

				// On enregistre l'entité créée avec persist
				// et flush
				$entityManager->persist( $book );
				$entityManager->flush();
			}
		}

		return $this->render('book/bookFormInsert.html.twig',
			[
				// envoie de la view du form au fichier twig
				'formBookView' => $formBookView
			]
		);

	}

	/**
	 * @Route("admin/books/{id}/form_update", name="books_form_update")
	 */
	public function bookFormUpdate($id, Request $request, BookRepository $bookRepository, EntityManagerInterface $entityManager)
	{
		// Utilisation du fichier BookType pour créer le formulaire
		// (ne contient pas encore de html)

		$book = $bookRepository->find($id);

		$form = $this->createForm(BookType::class, $book);
		// création de la view du formulaire
		$formBookView = $form->createView();


		// Si la méthode est POST
		// si le formulaire est envoyé
		if ($request->isMethod('Post')) {

			// Le formulaire récupère les infos
			// de la requête
			$form->handleRequest($request);

			// on vérifie que le formulaire est valide
			if ($form->isValid()) {

				// On enregistre l'entité créée avec persist
				// et flush
				$entityManager->persist( $book );
				$entityManager->flush();
			}
		}

		return $this->render('book/bookFormInsert.html.twig',
			[
				// envoie de la view du form au fichier twig
				'formBookView' => $formBookView
			]
		);

	}
}
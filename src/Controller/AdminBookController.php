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
	 * @Route("/admin", name="admin_home")
	 */
	public function adminHome(BookRepository $bookRepository, EntityManagerInterface $entityManager)
	{

		return $this->render('adminHome.html.twig');
	}


	/**
	 * @Route("/admin/books", name="admin_books_list")
	 */
	public function adminBookList(BookRepository $bookRepository, EntityManagerInterface $entityManager)
	{
		$books = $bookRepository->findAll();

		return $this->render('book/admin/bookList.html.twig',
			[
				// envoie de la view du form au fichier twig
				'books' => $books
			]
		);
	}

	/**
	 * @Route("/admin/books/insert", name="admin_books_insert")
	 */
	public function adminBookFormInsert(Request $request, EntityManagerInterface $entityManager)
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

		return $this->render('book/admin/bookInsert.html.twig',
			[
				// envoie de la view du form au fichier twig
				'formBookView' => $formBookView
			]
		);

	}

	/**
	 * @Route("/admin/books/{id}/update", name="admin_books_update")
	 */
	public function adminBookFormUpdate($id, Request $request, BookRepository $bookRepository, EntityManagerInterface $entityManager)
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

		return $this->render('book/admin/bookInsert.html.twig',
			[
				// envoie de la view du form au fichier twig
				'formBookView' => $formBookView
			]
		);

	}

	/**
	 * @Route("admin/books/{id}/delete", name="admin_books_delete")
	 *
	 * Je récupère la valeur de la wildcard {id} dans la variable id
	 * Je récupère le bookRepository car j'ai besoin d'utiliser la méthode find
	 * Je récupère l'entityManager car c'est lui qui me permet de gérer les entités (ajout, suppression, modif)
	 */
	public function deleteBook($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
	{
		// je récupère ;le livre dans la BDD qui a l'id qui correspond à la wildcard
		// ps : c'est une entité qui est récupérée
		$book = $bookRepository->find($id);

		// j'utilise la méthode remove() de l'entityManager en spécifiant
		// le livre à supprimer
		$entityManager->remove($book);
		$entityManager->flush();

		return $this->render('book/admin/bookDelete.html.twig',
			[
				// envoie de la view du form au fichier twig
				'book' => $book
			]
		);
	}
}
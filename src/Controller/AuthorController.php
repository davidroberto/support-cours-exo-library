<?php


namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AuthorController extends AbstractController
{

	/**
	 * @Route("/authors", name="authors")
	 */
	public function authorsIndex()
	{
		return $this->render('author/index.html.twig');
	}

	/**
	 * @Route("/authors/bio", name="authors_bio")
	 */
	public function authorsByBiography(AuthorRepository $authorRepository, Request $request)
	{

		// je récupère la chaine de caractère envoyée dans l'url par le formulaire
		$word = $request->query->get('word');

		// j'appelle la méthode getAuthorsByBio() que j'ai créée dans le repository Author
		// et je lui passe la chaine de caractères envoyée par le formulaire
		$authors = $authorRepository->getAuthorsByBio($word);

		return $this->render('author/authorByBio.html.twig', [
			'authors' => $authors
			]

		);
	}

	/**
	 * @Route("/authors/list", name="authors_list")
	 */
	public function authorsList(AuthorRepository $authorRepository)
	{
		$authors = $authorRepository->findAll();

		return $this->render('author/authorList.html.twig',
			[
				'authors' => $authors
			]
		);

	}

	/**
	 * @Route("/authors/form_insert", name="authors_form_insert")
	 */
	public function authorFormInsert(Request $request, EntityManagerInterface $entityManager)
	{
		// Utilisation du fichier AuthorType pour créer le formulaire
		// (ne contient pas encore de html)

		$author = new Author();

		$form = $this->createForm(AuthorType::class, $author);
		// création de la view du formulaire
		$formAuthorView = $form->createView();


		// Si la méthode est POST
		// si le formulaire est envoyé
		if ($request->isMethod('Post')) {

			// Le formulaire récupère les infos
			// de la requête
			$form->handleRequest($request);

			// On enregistre l'entité créée avec persist
			// et flush
			$entityManager->persist($author);
			$entityManager->flush();
		}

			return $this->render('author/authorFormInsert.html.twig',
			[
				// envoie de la view du form au fichier twig
				'formAuthorView' => $formAuthorView
			]
		);

	}


}
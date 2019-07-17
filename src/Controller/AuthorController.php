<?php


namespace App\Controller;

use App\Repository\AuthorRepository;
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

}
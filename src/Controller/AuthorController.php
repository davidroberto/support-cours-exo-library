<?php


namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AuthorController extends AbstractController
{

	/**
	 * @Route("/authors/bio/{word}", name="authors_bio")
	 */
	public function authorsByBiography($word, AuthorRepository $authorRepository)
	{
		// j'appelle la méthode getAuthorsByBio() que j'ai créée dans le repository Author
		// et je lui passe la chaine de caractères mise par l'utilisateur dans la wildcard
		$authors = $authorRepository->getAuthorsByBio($word);

		var_dump($authors); die;
	}

}
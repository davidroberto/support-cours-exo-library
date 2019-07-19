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


class AdminAuthorController extends AbstractController
{
	/**
	 * @Route("/admin/authors/form_insert", name="authors_form_insert")
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

			// on vérifie que le formulaire est valide
			if ($form->isValid()) {

				// On enregistre l'entité créée avec persist
				// et flush
				$entityManager->persist( $author );
				$entityManager->flush();
			}
		}

		return $this->render('author/authorFormInsert.html.twig',
			[
				// envoie de la view du form au fichier twig
				'formAuthorView' => $formAuthorView
			]
		);

	}

	/**
	 * @Route("admin/authors/{id}/form_update/", name="authors_form_update")
	 */
	public function authorFormUpdate($id, Request $request, AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
	{
		// Utilisation du fichier AuthorType pour créer le formulaire
		// (ne contient pas encore de html)

		$author = $authorRepository->find($id);

		$form = $this->createForm(AuthorType::class, $author);
		// création de la view du formulaire
		$formAuthorView = $form->createView();


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
				$entityManager->persist( $author );
				$entityManager->flush();
			}
		}

		return $this->render('author/authorFormInsert.html.twig',
			[
				// envoie de la view du form au fichier twig
				'formAuthorView' => $formAuthorView
			]
		);

	}
}
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
	 * @Route("/admin/authors", name="admin_author_list")
	 */
	public function adminAuthorList(AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
	{
		$authors = $authorRepository->findAll();

		return $this->render('author/admin/authorList.html.twig',
			[
				// envoie de la view du form au fichier twig
				'authors' => $authors
			]
		);
	}

	/**
	 * @Route("/admin/authors/insert", name="admin_author_insert")
	 */
	public function adminAuthorFormInsert(Request $request, EntityManagerInterface $entityManager)
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

		return $this->render('author/admin/authorInsert.html.twig',
			[
				// envoie de la view du form au fichier twig
				'formAuthorView' => $formAuthorView
			]
		);

	}

	/**
	 * @Route("/admin/authors/{id}/update", name="admin_author_update")
	 */
	public function adminAuthorFormUpdate($id, Request $request, AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
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

		return $this->render('author/admin/authorInsert.html.twig',
			[
				// envoie de la view du form au fichier twig
				'formAuthorView' => $formAuthorView
			]
		);

	}

	/**
	 * @Route("admin/authors/{id}/delete", name="admin_author_delete")
	 *
	 * Je récupère la valeur de la wildcard {id} dans la variable id
	 * Je récupère le authorRepository car j'ai besoin d'utiliser la méthode find
	 * Je récupère l'entityManager car c'est lui qui me permet de gérer les entités (ajout, suppression, modif)
	 */
	public function deleteAuthor($id, AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
	{
		// je récupère ;le livre dans la BDD qui a l'id qui correspond à la wildcard
		// ps : c'est une entité qui est récupérée
		$author = $authorRepository->find($id);

		// j'utilise la méthode remove() de l'entityManager en spécifiant
		// le livre à supprimer
		$entityManager->remove($author);
		$entityManager->flush();

		return $this->render('author/admin/authorDelete.html.twig',
			[
				// envoie de la view du form au fichier twig
				'author' => $author
			]
		);
	}
}
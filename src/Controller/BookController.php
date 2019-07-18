<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/book/list", name="book_list")
     *
     * Je passe en parametre la classe "EntityManagerInterface" avec la variable
     * $entityManager, pour que Symfony mette dans la variable une instance de la
     * classe
     */
    public function bookList(BookRepository $bookRepository)
    {

	    // j'utilise la méthode findAll du repository pour récupérer tous mes Book
	    $books = $bookRepository->findAll();

	    dump($books); die;
    }

	/**
	 * @Route("/book/show", name="book_show")
	 */
    public function bookShow(BookRepository $bookRepository)
    {
    	// j'utilise la méthode find du BookRepository afin
	    // de récupérer un livre dans la table Book en fonction
	    // de son id
	    $book = $bookRepository->find(3);

	    dump($book); die;
    }


	/**
	 * @Route("/book/style", name="book_style")
	 */
    public function booksByStyle(BookRepository $bookRepository)
    {
	    // j'appelle la méthode findByGenre() que j'ai créée dans le repository Author pour afficher des livres en fonction de leur genre
	    // le genre est défini en "dur" dans le repository
	    // ATTENTION IL EXISTE PAR DEFAUT UNE METHODE FINDBY() QUI PERMET DE FAIRE LA MEME CHOSE
    	$books = $bookRepository->findByGenre();

    	var_dump($books); die;
    }


	/**
	 * @Route("/book/insert", name="book_insert")
	 *
	 * je mets en parametre de la méthode l'entity manager
	 * car c'est l'outil qui me permet de gérer mes entités
	 */
    public function insertBook(EntityManagerInterface $entityManager)
    {

    	// je créé une nouvelle instance de l'entité Book
	    // c'est cette entité qui est le miroir de la table Book
    	$book = new Book();

    	// je set toutes les infos de mon livres grâce aux setters
	    // créés dans l'entité
    	$book->setTitle('titre test');
    	$book->setNbPages(1234);
    	$book->setSummary('resumé de mon livre test');
    	$book->setStyle('Thriller');


    	// j'enregistre mon livre en base de données
	    // avec les méthodes persist() et flush()
	    $entityManager->persist($book);
	    $entityManager->flush();

	    var_dump("livre enregistré"); die;

    }

	/**
	 * @Route("/book/{id}/delete", name="book_delete")
	 *
	 * Je récupère la valeur de la wildcard {id} dans la variable id
	 * Je récupère le bookRepository car j'ai besoin d'utiliser la méthode find
	 * Je récupère l'entityManager car c'est lui qui me permet de gérer les entités (ajout, suppression, modif)
	 */
    public function deleteBook($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
    	// je récupère le livre dans la BDD qui a l'id qui correspond à la wildcard
	    // ps : c'est une entité qui est récupérée
	    $book = $bookRepository->find($id);

	    // j'utilise la méthode remove() de l'entityManager en spécifiant
	    // le livre à supprimer
	    $entityManager->remove($book);
	    $entityManager->flush();

	    var_dump("livre supprimé"); die;
    }


}

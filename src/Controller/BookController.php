<?php

namespace App\Controller;

use App\Repository\BookRepository;
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


}

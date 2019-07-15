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
}

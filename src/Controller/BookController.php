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
     * @Route("/booklist", name="book")
     *
     * Je passe en parametre la classe "EntityManagerInterface" avec la variable
     * $entityManager, pour que Symfony mette dans la variable une instance de la
     * classe
     */
    public function index(EntityManagerInterface $entityManager)
    {

    	// j'utilise l'instance de la classe entity Manager, pour récupérer
	    // le répository des Book.
	    // j'ai besoin du repository pour faire des requetes SELECT dans la table
	    $bookRepository = $entityManager->getRepository(Book::class);

	    // j'utilise la méthode findAll du repository pour récupérer tous mes Book
	    $books = $bookRepository->findAll();

	    dump($books); die;
    }
}

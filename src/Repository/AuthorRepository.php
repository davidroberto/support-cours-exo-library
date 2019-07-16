<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Author::class);
    }


    // méthode pour trouver des auteurs en fonction d'un mot de leur biographie


	// afficher la variable

	public function getAuthorsByBio()
	{

		// LIGNE A MODIFIER, VALEUR A RECUPERER DEPUIS L'URL (DONC A TRAITER DANS LE CONTROLEUR)
		$word = 'david';

		// je récupère le query builder, qui me permet de créer des
		// requetes SQL
		$qb = $this->createQueryBuilder('a');

		// je sélectionne tous les auteurs de la base de données
		$query = $qb->select('a')

			// si le 'word' est trouvé dans la biographie
			->where('a.biography LIKE :word')

			// j'utilise le setParameter pour sécuriser la requete
			->setParameter('word', '%'.$word.'%')

			// je créé la requete SQL
			->getQuery();

		// je récupère les résultats sous forme d'array
		$resultats = $query->getArrayResult();

		return $resultats;
	}
}

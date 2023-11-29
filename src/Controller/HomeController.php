<?php

// src/Controller/HomeController.php

namespace App\Controller;


use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: "home_route")]
    public function index(EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
        $queryBuilder = $em->getRepository(Livre::class)->createQueryBuilder('l');
    
        //Appliquez les filtres ici en fonction des paramètres de requête
        if ($request->query->get('author') && $request->query->get('author') != 'none') {
            $queryBuilder->andWhere('l.Auteur = :auteur')
                         ->setParameter('auteur', $request->query->get('author'));
        }
           //Récupérez la liste complète des auteurs
    $auteurs = $em->getRepository(Livre::class)->createQueryBuilder('l')
    ->select('l.Auteur')
    ->distinct(true)
    ->getQuery()
    ->getResult();
  
    if ($request->query->get('category') && $request->query->get('category') != 'none') {
        $queryBuilder->andWhere('l.Categorie = :category')
                     ->setParameter('category', $request->query->get('category'));
    }

    $categories = $em->getRepository(Livre::class)->createQueryBuilder('l')
                     ->select('l.Categorie')
                     ->distinct(true)
                     ->getQuery()
                     ->getResult();

    if ($request->query->get('date') && $request->query->get('date') != 'none') {
                        $queryBuilder->andWhere('l.Date_de_Paruption = :date')
                                     ->setParameter('date', $request->query->get('date'));
                    }
                
    $dates = $em->getRepository(Livre::class)->createQueryBuilder('l')
                                     ->select('l.Date_de_Paruption')
                                     ->distinct(true)
                                     ->getQuery()
                                     ->getResult();

    if ($request->query->get('titre') && $request->query->get('titre') != 'none') {
                                        $queryBuilder->andWhere('l.Titre = :titre')
                                                     ->setParameter('titre', $request->query->get('titre'));
                                    }
                                
    $titres = $em->getRepository(Livre::class)->createQueryBuilder('l')
                                                     ->select('l.Titre')
                                                     ->distinct(true)
                                                     ->getQuery()
                                                     ->getResult();
                



        $pagination = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->getInt('page', 1),
            3 // Nombre d'éléments par page
        );
    
        return $this->render('home/index.html.twig', [
            'livres' => $pagination,
            'auteurs' => $auteurs,
            'categories' => $categories,
            'dates' => $dates,
            'titres' => $titres,
        ]);
    }
}

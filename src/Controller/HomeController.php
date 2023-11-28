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
        $livresQuery = $em->getRepository(Livre::class)->createQueryBuilder('l');

        $pagination = $paginator->paginate(
            $livresQuery,
            $request->query->getInt('page', 1),
            3 // Nombre d'éléments par page
        );

        return $this->render('home/index.html.twig', [
            'livres' => $pagination,
        ]);
    }
}
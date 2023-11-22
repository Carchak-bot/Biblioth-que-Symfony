<?php

// src/Controller/HomeController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: "home_route")]
    public function index(EntityManagerInterface $em): Response
    {
        $livres = $em->getRepository(Livre::class)->findAll();

        return $this->render('home/index.html.twig', [
            'livres' => $livres,
        ]);
    }

    #[Route('/livre/{id}', name: 'details_livre')]
    public function detailsLivre(EntityManagerInterface $em, Livre $livre): Response
    {
        return $this->render('livre/details.html.twig', [
            'livre' => $livre,
        ]);
    }
}
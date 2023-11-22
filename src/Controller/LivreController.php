<?php

namespace App\Controller; 

use App\Form\LivreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class LivreController extends AbstractController
{
    #[Route('/livre/add', name: 'livres_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $livre = new Livre();
    
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($livre);
            $entityManager->flush();
    
            return $this->redirectToRoute('home_route');
        }
    
        return $this->render('livre/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
    
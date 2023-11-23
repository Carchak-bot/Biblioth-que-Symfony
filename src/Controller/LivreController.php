<?php

// src/Controller/LivreController.php

namespace App\Controller; 

use App\Form\LivreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LivreController extends AbstractController
{
    #[Route('/livre/add', name: 'livres_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $livre = new Livre();

        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);
        dump($livre);

        if ($form->isSubmitted() && $form->isValid()) {
            
            /** @var UploadedFile $ImageFile */
            $ImageFile = $form['ImageFile']->getData();

            if ($ImageFile) {
                $newImageName = $this->uploadImage($ImageFile);
                $livre->setImageName($newImageName);
            }

            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('home_route');
        }

        return $this->render('livre/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function uploadImage(UploadedFile $imageFile): string
    {
        $destination = $this->getParameter('kernel.project_dir') . '/public/img/CouvertureLivres';
        $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $originalFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

        $imageFile->move($destination, $newFilename);

        return $newFilename;
    }


    #[Route('/livre/supprimer/{id}', name: 'supprimer_livre')]
    public function supprimerLivre(Livre $livre, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($livre);
        $entityManager->flush();
    
        return $this->redirectToRoute('home_route');
    }
    #[Route('/livre/modifier/{id}', name: 'modifier_livre')]
    public function modifierLivre(Livre $livre, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LivreType::class, $livre);  // Utilisez LivreType ici
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            
            $ImageFile = $form['ImageFile']->getData();
    
            if ($ImageFile) {
                $newImageName = $this->uploadImage($ImageFile);
                $livre->setImageName($newImageName);
            }
    
            $entityManager->flush();
    
            return $this->redirectToRoute('details_livre', ['id' => $livre->getId()]);
        }
    
        return $this->render('livre/modifier.html.twig', [
            'form' => $form->createView(),
            'livre' => $livre,
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
<?php

// src/Controller/MembresController.php

namespace App\Controller;

use App\Entity\Membres;
use App\Form\MembreType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MembresRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MembresController extends AbstractController
{

    #[Route('/membres', name: 'liste_membres')]
    public function listeMembres(MembresRepository $membresRepository): Response
    {
        $membres = $membresRepository->findAll();

        return $this->render('membres/index.html.twig', [
            'membres' => $membres,
        ]);
    }

    #[Route('/membres/add', name: 'ajouter_membres')]
    public function ajouterMembresBdd(Request $request, ManagerRegistry $doctrine): Response
    {
        $membre = new Membres();
        $form = $this->createForm(MembreType::class, $membre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Appeler setPhotoFile avec le fichier photo
            $membre->setPhotoFile($form->get('PhotoFile')->getData());
        
            // Assurez-vous que la propriété PhotoName est correctement définie
            $membre->setPhotoName($form->get('PhotoFile')->getData()->getClientOriginalName());
            
            /** @var UploadedFile $PhotoFile */
            $PhotoFile = $form['PhotoFile']->getData();

            if ($PhotoFile) {
                $newPhotoName = $this->uploadPhoto($PhotoFile);
                $membre->setPhotoName($newPhotoName);
            }

            $entityManager = $doctrine->getManager();
            $entityManager->persist($membre);
            $entityManager->flush();
        
            return $this->redirectToRoute('home_route');
        }

        return $this->render('membres/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/membres/{id}', name: 'details_membre')]
    public function detailsMembre(Membres $membre): Response
    {
        return $this->render('membres/details.html.twig', [
            'membre' => $membre,
        ]);
    }

    private function uploadPhoto(UploadedFile $PhotoFile): string
    {
        $destination = $this->getParameter('kernel.project_dir') . '/public/img/PhotoUtilisateurs';
        $originalFilename = pathinfo($PhotoFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $originalFilename . '-' . uniqid() . '.' . $PhotoFile->guessExtension();

        $PhotoFile->move($destination, $newFilename);

        return $newFilename;
    }
}
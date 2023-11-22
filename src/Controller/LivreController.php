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
}
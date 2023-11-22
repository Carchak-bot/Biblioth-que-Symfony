<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Membres;

class MembresController extends AbstractController
{
    #[Route('/membres', name: 'liste_membres')]
    public function index(): Response
    {
        $Membres = new Membres;
        
        return $this->render('membres/index.html.twig', [
            'controller_name' => 'Employé 427',
        ]);
    }

    #[Route('/membres/add', name: 'ajout_membres')]
    public function ajoutMembres(): Response
    {
        return $this->render('membres/ajout.html.twig', [
            'controller_name' => 'Employé 427',
        ]);
    }

    #[Route('/membres/added', name: 'ajouter_membres')]
    public function ajouterMembresBdd(ManagerRegistry $doctrine): Response
    {
        // $name = null;
        //Traitement photo
        if (isset($_FILES['Photo'])) {
            $tmpName = $_FILES['Photo']['tmp_name'];
            $name = $_FILES['Photo']['name'];
            $size = $_FILES['Photo']['size'];
            $error = $_FILES['Photo']['error'];
        } 
        
        $tabExtension = explode('.', $name);
        $extension = strtolower(end($tabExtension));
        
        //Tableau des extensions que l'on accepte
        $extensions = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
        
        //Taille max que l'on accepte
        $maxSize = 100000000;
        
        if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
            move_uploaded_file($tmpName, '../../public/img/PhotoUtilisateurs/' . $name);
        } else {
            echo "Une erreur est survenue";
        }


        $entityManager = $doctrine->getManager();

        $Membres = new Membres;
        $Membres->setNom($_POST['Nom']);
        $Membres->setPrenom($_POST['Prenom']);
        $Membres->setStatut($_POST['Statut']);
        $Membres->setPhoto($name);

        $entityManager->persist($Membres);
        $entityManager->flush();
        return $this->render('membres/ajoutFait.html.twig', [
            'controller_name' => 'Employé 427',
        ]);
    }
}

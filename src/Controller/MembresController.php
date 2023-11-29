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
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class MembresController extends AbstractController
{
    #[Route('/membres', name: 'liste_membres')]
    public function listeMembres(EntityManagerInterface $em, Request $request, PaginatorInterface $paginator): Response
    {
        $query = $em->getRepository(Membres::class)->createQueryBuilder('m');
  
        //Appliquez les filtres ici en fonction des paramètres de requête
        if ($request->query->get('statut') && $request->query->get('statut') != 'none') {
            $query->andWhere('m.Statut = :statut')
                         ->setParameter('statut', $request->query->get('statut'));
        }
           //Récupérez la liste complète des auteurs
    $statuts = $em->getRepository(Membres::class)->createQueryBuilder('m')
    ->select('m.Statut')
    ->distinct(true)
    ->getQuery()
    ->getResult();
    
     //Appliquez les filtres ici en fonction des paramètres de requête
     if ($request->query->get('nom') && $request->query->get('nom') != 'none') {
        $query->andWhere('m.Nom = :nom')
                     ->setParameter('nom', $request->query->get('nom'));
    }
       //Récupérez la liste complète des auteurs
$noms = $em->getRepository(Membres::class)->createQueryBuilder('m')
->select('m.Nom')
->distinct(true)
->getQuery()
->getResult();

 //Appliquez les filtres ici en fonction des paramètres de requête
 if ($request->query->get('prenom') && $request->query->get('prenom') != 'none') {
    $query->andWhere('m.Prenom = :prenom')
                 ->setParameter('prenom', $request->query->get('prenom'));
}
   //Récupérez la liste complète des auteurs
$prenoms = $em->getRepository(Membres::class)->createQueryBuilder('m')
->select('m.Prenom')
->distinct(true)
->getQuery()
->getResult();

        $pagination = $paginator->paginate(
            $query, // Requête DQL
            $request->query->getInt('page', 1), // Numéro de la page à afficher
            3 // Nombre d'éléments par page
        );
    
        return $this->render('membres/index.html.twig', [
            'membres' => $pagination,
            'statuts' => $statuts,
            'noms' => $noms,
            'prenoms' => $prenoms,
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
        $livresEmpruntes = $membre->getLivres();
    
        return $this->render('membres/details.html.twig', [
            'membre' => $membre,
            'livresEmpruntes' => $livresEmpruntes,
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
    #[Route('/membres/modifier/{id}', name: 'modifier_membres')]
    public function modifierMembres(Membres $membre, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Dissociez les livres du membre seulement si le champ livre est présent dans le formulaire
            if ($form->has('livre') && $form->get('livre')->getData() !== null) {
                foreach ($membre->getLivres() as $livre) {
                    $livre->setIDEmprunteur(null);
                }
            }
    
            $entityManager->flush();
    
            return $this->redirectToRoute('details_membre', ['id' => $membre->getId()]);
        }
    
        return $this->render('membres/modifier.html.twig', [
            'form' => $form->createView(),
            'membre' => $membre,
        ]);
    }
    #[Route('/membres/supprimer/{id}', name: 'supprimer_membres')]
    public function supprimerMembres(Membres $membre, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($membre);
        $entityManager->flush();

        return $this->redirectToRoute('liste_membres');
    }
}
<?php
// Toutes les classes utilisées doivent etre importées
namespace App\Controller;

use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// EntrepriseController qui hérite de la class AbstractController ce qui va permettre d'accéder 
// à un certain nombre de méthode préétablie
final class EntrepriseController extends AbstractController
{
    // Route et Name par défaut prend le nom du controller
    // Name peut ete changer mais tjrs différent de l'ensbl des controller du projet
    #[Route('/entreprise', name: 'app_entreprise')]
    // Méthode index qui renvoie une response
    // Response 
   //1-  public function index(EntityManagerInterface $entityManager ): Response

   //-> on va faire passer le repository tout de suite 
    public function index(EntrepriseRepository $entrepriseRepository ): Response //2- 
    {
        // Render permet de faire le lien entre le controller et la vue

       //1-   $entreprises = $entityManager->getRepository(Entreprise::class)->findAll();
       // C'est ce que va traduire doctrine et ca correspond a  SELECT * FROM entreprise  where strasbourg ORDER BY raisonSociale ASC
       // Le premier tableau c'est le critère et la j'ai choisi a Strasbourg
        $entreprises = $entrepriseRepository->findby([], ["raisonSociale" => "ASC"]);  //2-
        return $this->render('entreprise/index.html.twig', [
           'entreprises' => $entreprises,
        ]);
    }


    #[Route('/entreprise/new', name: 'new_entreprise')]
    public function new(Request $request): Response
    {
        $entreprise = new Entreprise();

        $form = $this->createForm(EntrepriseType::class, $entreprise);

        return $this->render('entreprise/new.html.twig', [
            'formAddEntreprise' => $form,
        ]);
    }

   // Definir la route et Nb : pas le meme name et la meme url 
    #[Route('/entreprise/{id}', name: 'show_entreprise')]
    public function show(Entreprise $entreprise): Response
    {
        return $this->render('entreprise/show.html.twig', [
        'entreprise' => $entreprise,
        ]);
    }

}



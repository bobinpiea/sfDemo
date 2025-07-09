
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
        $entreprises = $entrepriseRepository->findAll();  //2-
        return $this->render('entreprise/index.html.twig', [
           'entreprises' => $entreprises,
        ]);
    }

    
}




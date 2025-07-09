<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Repository\EmployeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EmployeController extends AbstractController
{
    #[Route('/employe', name: 'app_employe')]
    public function index(EmployeRepository $employeRepository): Response
    {
        // $employes = $employeRepository->findAll(); 
        
        $employes = $employeRepository->findby([], ['nom' =>'ASC']); // = SELECT * FROM EMPLOYE ORDER BY nom ASC
        return $this->render('employe/index.html.twig', [
           'employes' => $employes,
        ]);
    }
    

       #[Route('/employe/{id}', name: 'show_employe')]
    public function show(Employe $employe): Response
    {
        return $this->render('employe/show.html.twig', [
        'employe' => $employe,
        ]);
    }


}

<?php

namespace App\Controller;

use App\Repository\PartnerRepository;
use App\Repository\StructureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route("/admin", name: "admin_")]
class AdminController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/partenaires', name: 'partners')]
    public function partnersList(PartnerRepository $partnerRepository)
    {
        return $this->render('partners.html.twig', [
            'partners' => $partnerRepository->findBy([])
        ]);
    }

    #[Route('/structures', name: 'structures')]
    public function structuresList(StructureRepository $structureRepository)
    {
        return $this->render('partners.html.twig', [
            'structures' => $structureRepository->findBy([])
        ]);
    }
}

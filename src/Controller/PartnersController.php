<?php

namespace App\Controller;

use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/partenaires', name: 'partners_')]
class PartnersController extends AbstractController
{
    #[Route('/', name: 'list')]
    public function partners(PartnerRepository $partnerRepository): Response
    {
        return $this->render('partners/partners.html.twig', [
            'partners' => $partnerRepository->findBy([]),
        ]);
    }
}

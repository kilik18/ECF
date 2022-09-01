<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Entity\Structure;
use App\Repository\PartnerRepository;
use App\Repository\StructureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/structures', name: 'structures_')]
class StructureController extends AbstractController
{
    #[Route('/', name: 'list')]
    public function structuresList(StructureRepository $structureRepository, PartnerRepository $partnerRepository): Response
    {
        return $this->render('structure/index.html.twig', [
            'structures' => $structureRepository->findBy([]),
            'partners' => $partnerRepository->findBy([]),
        ]);
    }
}

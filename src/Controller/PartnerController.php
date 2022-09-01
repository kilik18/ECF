<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Entity\Structure;
use App\Repository\StructureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/partenaire', name: 'partner_')]
class PartnerController extends AbstractController
{
    #[Route('/{id}', name: 'list')]
    public function structureList(Partner $partner, StructureRepository $structureRepository): Response
    {
        $structures = $partner->getStructure();

        return $this->render('partner/partner.html.twig', [
            'partner' => $partner,
            'structures' => $structures,
    ]);
    }
}

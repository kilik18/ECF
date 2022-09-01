<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profil', name: 'profile_')]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'details')]
    public function profile(UserRepository $userRepository): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController'
        ]);
    }
}

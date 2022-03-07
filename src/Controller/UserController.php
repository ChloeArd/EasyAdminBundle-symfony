<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[isGranted('IS_AUTHENTICATED_FULLY')]
class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(UserRepository $userRepository): Response
    {

        if ($this->isGranted("ROLE_ADMIN")) {
            $users = $userRepository->findAll();
        }
        else {
            $users = $userRepository->findBy(['roles' => ['ROLE_USER']]);
        }
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }
}

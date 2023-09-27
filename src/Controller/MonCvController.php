<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MonCvController extends AbstractController
{
    #[Route('/cv', name: 'cv')]
    public function index(): Response
    {
        return $this->render('mon_cv/cv.html.twig', [
            'controller_name' => 'MonCvController',
        ]);
    }
}

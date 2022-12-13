<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    /**
     * @Route("/menu", name="app_menu")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('menu/_menu.html.twig', [
            'animals'=>$doctrine->getRepository(Animal::class)->findAll()
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Paddock;
use App\Form\PaddockType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaddockController extends AbstractController
{
    /**
     * @Route("/paddock", name="app_paddock")
     */
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $paddock = new Paddock();
        $form = $this->createForm(PaddockType::class, $paddock);
        $form->handleRequest($request);

        $repo = $doctrine->getRepository(Paddock::class);
        $paddocks = $repo->findAll();

        return $this->render("paddock/index.html.twig", [
            'paddocks' => $paddocks,
            'formular' => $form->createView()
        ]);
    }
}

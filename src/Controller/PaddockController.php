<?php


namespace App\Controller;

use App\Entity\Paddock;
use App\Form\PaddockDeleteType;
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

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($paddock);
            $em->flush();
        }

        $repo = $doctrine->getRepository(Paddock::class);
        $paddocks = $repo->findAll();

        return $this->render("paddock/index.html.twig", [
            'paddocks' => $paddocks,
            'formular' => $form->createView()
        ]);
    }

    /**
     * @Route ("/paddock/modify/{id}", name="modify_paddock")
     */
    public function modifyPaddock($id, ManagerRegistry $doctrine, Request $request)//modifyPAddock to modifyPadock
    {
        $paddock = $doctrine->getRepository(Paddock::class)->find($id);
        if (!$paddock) {
            throw $this->createNotFoundException("No paddock found with the id $id");
        }
        $form = $this->createForm(PaddockType::class, $paddock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($paddock);
            $em->flush();
            return $this->redirectToRoute("app_paddock");

        }
        $repository = $doctrine->getRepository(Paddock::class);

        return $this->render('paddock/modify.html.twig', [
            'paddock' => $paddock,
            'formular' => $form->createView(),
        ]);


    }
    //suppression animal

    /**
     * @Route ("/paddock/delete/{id}", name="delete_paddock")
     */
    public function deletePaddock($id, ManagerRegistry $doctrine, Request $request) //deleteAnimal to deletePaddock
    {
        $paddock = $doctrine->getRepository(Paddock::class)->find($id);
        if (!$paddock) {
            throw $this->createNotFoundException("No paddock found with the id $id");
        }
        $form = $this->createForm(PaddockDeleteType::class, $paddock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->remove($paddock);
            $entityManager->flush();
            return $this->redirectToRoute("app_paddock");
        }

        return $this->render("paddock/delete.html.twig", [
            'paddock' => $paddock,
            'formular' => $form->createView()
        ]);
    }

}



//
//namespace App\Controller;
//
//use App\Entity\Paddock;
//use App\Form\PaddockType;
//use Doctrine\Persistence\ManagerRegistry;
//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;
//
//class PaddockController extends AbstractController
//{
//    /**
//     * @Route("/paddock", name="app_paddock")
//     */
//    public function index(ManagerRegistry $doctrine, Request $request): Response
//    {
//        $paddock = new Paddock();
//        $form = $this->createForm(PaddockType::class, $paddock);
//        $form->handleRequest($request);
//
//        $repo = $doctrine->getRepository(Paddock::class);
//        $paddocks = $repo->findAll();
//
//        return $this->render("paddock/index.html.twig", [
//            'paddocks' => $paddocks,
//            'formular' => $form->createView()
//        ]);
//    }
//}

<?php

namespace App\Controller;

use App\Entity\Space;
use App\Form\SpaceDeleteType;
use App\Form\SpaceType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SpaceController extends AbstractController
{

    /**
     * @Route("/spaces", name="spaces")
     */
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $space = new Space();
        $form = $this->createForm(SpaceType::class, $space);
        // je gère la réponse
        $form->handleRequest($request);

        $repo = $doctrine->getRepository(Space::class);
        $spaces = $repo->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if ((($data->getOpenDate()) && ($data->getOpenDate()->getTimestamp() <= $data->getCloseDate()->getTimestamp())) || !$data->getCloseDate()){
                $entityManager = $doctrine->getManager();
                $entityManager->persist($data);
                $entityManager->flush();
                return $this->redirectToRoute("spaces"); //"Actualise" la page, affiche les currents animals
            }
            else if ($data->getOpenDate() == NULL && $data->getCloseDate() != NULL){
                $this->addFlash('error', "If there's a closing date, there must be a opening date dude");
                return $this->render('space/index.html.twig', [
                    'spaces' => $spaces,
                    'formular' => $form->createView(),
                ]);
            }else if ($data->getOpenDate() != NULL && $data->getCloseDate() != NULL && $data->getCloseDate()->getTimestamp() < $data->getOpenDate()->getTimestamp()){
                $this->addFlash('error', "the closing date must be later than the opening date, logic isn't it?");
                return $this->render('space/index.html.twig', [
                    'spaces' => $spaces,
                    'formular' => $form->createView(),
                ]);
            }
        }

        return $this->render("space/index.html.twig", [
            'spaces' => $spaces,
            'formular' => $form->createView()
        ]);
    }
    //modification space

    /**
     * @Route ("/space/modify/{id}", name="modify_space")
     */
    public function modifySpace($id, ManagerRegistry $doctrine, Request $request)
    {
        //Je récup l'espace de la BDD
        $space = $doctrine->getRepository(Space::class)->find($id);
        //je gère l'erreur
        if (!$space) {
            throw $this->createNotFoundException("No space found with the id $id");
        }
        //Création du formulaire (déjà rempli grâce à l'ID)
        $form = $this->createForm(SpaceType::class, $space);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($space);
            $em->flush();
            return $this->redirectToRoute("spaces"); //"Actualise" la page, affiche les currents animals
        }

        $repository = $doctrine->getRepository(Space::class);
        $spaces = $repository->findAll();

        return $this->render('space/index.html.twig', [
            'spaces' => $spaces,
            'formular' => $form->createView(),
        ]);


    }
    //suppression animal

    /**
     * @Route ("/space/delete/{id}", name="delete_space")
     */
    public function deleteSpace($id, ManagerRegistry $doctrine, Request $request)
    {
        $space = $doctrine->getRepository(Space::class)->find($id);
        if (!$space) {
            throw $this->createNotFoundException("No space found with the id $id");
        }
        $form = $this->createForm(SpaceDeleteType::class, $space);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->remove($space);
            $entityManager->flush();
            return $this->redirectToRoute("spaces");
        }
        return $this->render("space/delete.html.twig", [
            'space' => $space,
            'formular' => $form->createView()
        ]);
    }
}

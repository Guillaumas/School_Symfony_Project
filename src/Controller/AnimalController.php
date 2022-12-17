<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalDeleteType;
use App\Form\AnimalType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AnimalController extends AbstractController
{

    //Route absolue
    /**
     * @Route("/", name="app_home")
     */
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $animal = new Animal();
        $form = $this->createForm(AnimalType::class, $animal);
        // je gère la réponse
        $form->handleRequest($request);

        $repo = $doctrine->getRepository(Animal::class);
        $animals = $repo->findAll();

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            //DDN condition
            if ($data->getBrithDate() == null || ($data->getBrithDate()->getTimestamp() <= $data->getArrivalDate()->getTimestamp())) {
                //DDD condition
                if ($data->getDepartureDate() == null || $data->getDepartureDate()->getTimestamp() > $data->getArrivalDate()->getTimestamp()) {
                    //Si sexe non précisé et stérilisé, alors je dégage
                    if ($data->getGender() == "undefined" && $data->isSterilized()) {
                        //je dégage pour le sexe
                        $this->addFlash('error', "You can't know if he's strerilized if ou didn't check his pp right?");
                        return $this->render('animal/index.html.twig', [
                            'animals' => $animals,
                            'formular' => $form->createView(),
                        ]);
                        //Si mon string est bien des nombres uniquement et fait 14 de long
                    } else if (strlen($data->getIdentificationNumber()) == 14 && ctype_digit($data->getIdentificationNumber())) {

                        // BY SIMON
                        if ($data->getPaddock()->getMaxAnimals() > sizeof($data->getPaddock()->getAnimals())) {
                            $entityManager = $doctrine->getManager();
                            $entityManager->persist($data);
                            $entityManager->flush();
                            return $this->redirectToRoute("app_home"); //"Actualise" la page, affiche les currents animals

                        }else {
                            $this->addFlash("error", "Not enough place in your Paddock");
                        }
                        // BY SIMON

                    } else {
                        //je dégage pour l'id
                        $this->addFlash('error', 'the id must 14 NUMBERS long');
//                        return $this->render('animal/index.html.twig', [
//                            'animals' => $animals,
//                            'formular' => $form->createView(),
//                        ]);
                    }
                } else {
                    //je dégage pour la DDD
                    $this->addFlash('error', "the departure date must be later than the arrival date, logic isn't it?");
//                    return $this->render('animal/index.html.twig', [
//                        'animals' => $animals,
//                        'formular' => $form->createView(),
//                    ]);
                }
            } else {
                //je dégage pour la DDN
                $this->addFlash('error', "Birth date must be sonner than the arrival date");
//                return $this->render('animal/index.html.twig', [
//                    'animals' => $animals,
//                    'formular' => $form->createView(),
//                ]);
            }
        }
        return $this->render("animal/index.html.twig", [
            'animals' => $animals,
            'formular' => $form->createView()
        ]);
    }
    //modification animal

    /**
     * @Route ("/animal/modify/{id}", name="modify_animal")
     */
    public function modifyAnimal($id, ManagerRegistry $doctrine, Request $request)
    {
        //Je récup l'animal de la BDD
        $animal = $doctrine->getRepository(Animal::class)->find($id);
        //je gère l'erreur
        if (!$animal) {
            throw $this->createNotFoundException("No animal found with the id $id");
        }
        //Création du formulaire (déjà rempli grâce à l'ID)
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($animal);
            $em->flush();
        }

        $repository = $doctrine->getRepository(Animal::class);
        $animals = $repository->findAll();

        return $this->render('animal/index.html.twig', [
            'animals' => $animal,
            'formular' => $form->createView(),
        ]);


    }
    //suppression animal

    /**
     * @Route ("/animal/delete/{id}", name="delete_animal")
     */
    public function deleteAnimal($id, ManagerRegistry $doctrine, Request $request)
    {
        $animal = $doctrine->getRepository(Animal::class)->find($id);
        if (!$animal) {
            throw $this->createNotFoundException("No animal found with the id $id");
        }
        $form = $this->createForm(AnimalDeleteType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->remove($animal);
            $entityManager->flush();
            return $this->redirectToRoute("app_home");
        }
        return $this->render("animal/delete.html.twig", [
            'animal' => $animal,
            'formular' => $form->createView()
        ]);
    }
}

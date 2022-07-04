<?php

namespace App\Controller;

use App\Entity\Enseignant;
use App\Entity\Etudiant;
use App\Entity\Universite;
use App\Entity\Salle;
use App\Entity\Batiment;
use App\Entity\Reservation;
////////////////////////////////
use App\Form\EnseignantType;
use App\Form\EtudiantType;
use App\Form\UniversiteType;
use App\Form\SalleType;
use App\Form\BatimentType;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="display_admin")
     */
    public function indexAdmin(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/index.html.twig');

    }

    /**
     * @Route("/addEnseignant", name="addEn")
     */
    public function addEnseignant(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $enseignant = new Enseignant();

        $form = $this->createForm(EnseignantType::class,$enseignant);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($enseignant);//Add
            $em->flush();

            return $this->redirectToRoute('addEn');
        }
        return $this->render('admin/ajoutEN.html.twig',['formEN'=>$form->createView()]);
    }

    /**
     * @Route("/addEtudiant", name="addEt")
     */
    public function addEtudiant(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $etudiant = new Etudiant();

        $form = $this->createForm(EtudiantType::class,$etudiant);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);//Add
            $em->flush();

            return $this->redirectToRoute('addEt');
        }
        return $this->render('admin/ajoutET.html.twig',['formET'=>$form->createView()]);
    }

    /**
     * @Route("/addBatiment", name="addBt")
     */
    public function addBatiment(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $batiment = new Batiment();

        $form = $this->createForm(BatimentType::class,$batiment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($batiment);//Add
            $em->flush();

            return $this->redirectToRoute('addBt');
        }
        return $this->render('admin/ajoutBT.html.twig',['formBT'=>$form->createView()]);
    }

    /**
     * @Route("/addUniversite", name="addUn")
     */
    public function addUniversite(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $universite = new Universite();

        $form = $this->createForm(UniversiteType::class,$universite);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($universite);//Add
            $em->flush();

            return $this->redirectToRoute('addUn');
        }
        return $this->render('admin/ajoutUN.html.twig',['formUN'=>$form->createView()]);
    }

    /**
     * @Route("/addSalle", name="addSa")
     */
    public function addSalle(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $salle = new Salle();

        $form = $this->createForm(SalleType::class,$salle);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $salle->setEtat('libre');
            $em = $this->getDoctrine()->getManager();
            $em->persist($salle);//Add
            $em->flush();

            return $this->redirectToRoute('addSa');
        }
        return $this->render('admin/ajoutSA.html.twig',['formSA'=>$form->createView()]);
    }

    /**
     *  @Route("/listSalleReserver", name="display_user")
     */
   public function salleReserver()
   {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');
       $salleReserver = $this->getDoctrine()->getManager()->getRepository(Reservation::class)->findAll();
       return $this->render('reservation/listSalleReserve.html.twig', [
           "salle"=>$salleReserver,
       ]);
   }
}

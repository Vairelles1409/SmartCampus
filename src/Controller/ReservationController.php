<?php

namespace App\Controller;

use App\Entity\Periode;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\Reservation;
use App\Repository\PeriodeRepository;
use App\Entity\Salle;
use App\Entity\User;
use App\Form\ReservationType;
use App\Repository\UserRepository;
use App\Repository\SalleRepository;
use App\Form\SalleType;
use App\Repository\ReservationRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\Container;
class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="app_reservation")
     */
    public function reservation(): Response{

        $salleReserver = $this->getDoctrine()->getManager()->getRepository(Salle::class)->findAll();
        $user=$this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        $periode1 = $this->getDoctrine()->getManager()->getRepository(Periode::class)->findBy(['id'=>1]);
        $periode2 = $this->getDoctrine()->getManager()->getRepository(Periode::class)->findBy(['id'=>2]);
        $periode3 = $this->getDoctrine()->getManager()->getRepository(Periode::class)->findBy(['id'=>3]);
        return $this->render('reservation/listReservation.html.twig', [
            "user"=>$user,
            "reserver"=>$salleReserver,
            "b1"=>$periode1,
            "b2"=>$periode2,
            "b3"=>$periode3,
        ]);
    }
  /**
   * Permet de reserver une salle
   * 
   * @Route("/reservation/{id}", name="app_reservation")
   * @return Response
   */
  public function reservationEffectuer($id): Response
  {
    $reservation= new Reservation();

    $salle= new Salle();
    $periode=new Periode();
    $user=new User();

    $libelle=$periode->getId();
    $utilisateur=$user->getId();

     $salle = $this->getDoctrine()->getManager()->getRepository(Salle::class)->find($id);
     $periode = $this->getDoctrine()->getManager()->getRepository(Periode::class)->find($id);
     $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($id);
        
        $etat=$salle->getEtat();
        if($etat=='libre'){
        $salle->setEtat('reservé') ;
        $em = $this->getDoctrine()->getManager();
        $em->persist($salle);
        $em->flush();
        //////////////////
       
        $libelle;
        $utilisateur;
        $salle->setEtat('reservé')->getId() ;
        $em = $this->getDoctrine()->getManager();
        $em->persist($reservation);
        $em->flush();


    }
      return $this->redirectToRoute('reservation');
 }
  /**
   * Permet de reserver une salle
   * 
   * @Route("/reservationAnnuler/{id}", name="app_reservation1")
   * @return Response
   */
  public function reservationAnnuler($id): Response
  {
   
    $salle= new Salle();
        $salle = $this->getDoctrine()->getManager()->getRepository(Salle::class)->find($id);
        $etat=$salle->getEtat();
        if($etat=='reservé'){
        $salle->setEtat('libre') ;
        $em = $this->getDoctrine()->getManager();
        $em->persist($salle);
        $em->flush();
    }
      return $this->redirectToRoute('reservation');
 }
}


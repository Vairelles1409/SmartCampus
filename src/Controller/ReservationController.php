<?php

namespace App\Controller;

use App\Entity\Periode;
use App\Entity\Reservation;
use App\Entity\Salle;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
public function reservationEffectuer($id){
  $salle= new Salle();
  $salleReserver= new Salle();
  $salle = $this->getDoctrine()->getManager()->getRepository(Salle::class)->find($id);
/////////////////mise à jour de l'état de la salle
        $etat=$salle->getEtat();
        if($etat=='libre'){
        $salle->setEtat('reservé') ;
        $em = $this->getDoctrine()->getManager();
        $em->persist($salle);
        $em->flush();
////////////////Recherche de l'utilisateur
  //$user= new User();
  $user = $this->getUser();
  $repository = $this->getDoctrine()->getRepository(User::class);
  $userConnect=$repository->find(['id'=>$user->getId()]);
  //$userConnect=$repository->find($id);
  ////////////////Recherche de la periode choisi
  ////////////////Création de la nouvelle reservation
  $reservation= new Reservation();
  $salleReserver=$salle;
  $reservation->setSalle($salleReserver);
  $reservation->setUser($userConnect);
  
  $entityManager = $this->getDoctrine()->getManager();
  $entityManager->persist($reservation);
  $entityManager->flush();

  return new Response(
    'Saved new Reservation with id: '.$reservation->getId()
    .' and new Salle with id: '.$salle->getId().' by User with id: '.$user->getUsername());
    
    
}
return $this->redirectToRoute('reservation');
}
  /**
   * Permet de reserver une salle
   * 
   * @Route("/reservation_Annuler/{id}", name="app_reservation1")
   * @return Response
   */
  public function reservationAnnuler($id): Response
  {
    
  ///////////////////changement d'état de la salle
    $salle= new Salle();
        $salle = $this->getDoctrine()->getManager()->getRepository(Salle::class)->find($id);
        $etat=$salle->getEtat();
        if($etat=='reservé'){
        $salle->setEtat('libre') ;
        $em = $this->getDoctrine()->getManager();
        $em->persist($salle);
        $em->flush();
    }
  /////////////////////Suppression de la reservation en BD
        $reservation= new Reservation;
        $ann_reservation=$reservation;

        $enm = $this->getDoctrine()->getManager();
        $enm->remove($ann_reservation);
        $enm->flush();
      return $this->redirectToRoute('reservation');
 }
}


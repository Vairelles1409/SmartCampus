<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Periode;
use App\Entity\Reservation;
use App\Entity\Salle;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        $reservation=$this->getDoctrine()->getManager()->getRepository(Reservation::class)->findAll();
        return $this->render('reservation/listReservation.html.twig', [
            "user"=>$user,
            "reserver"=>$salleReserver,
            "reserver2"=>$reservation
        ]);
    }

  /**
   * Permet de reserver une salle
   * 
   * @Route("/reservation/{id}", name="app_reservation")
   * @return Response
   */
public function reservationEffectuer($id, Request $request){
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
  return $this->redirectToRoute('reservation');
  // return new Response(
  //   'Saved new Reservation with id: '.$reservation->getId()
  //   .' and new Salle with id: '.$salle->getId().' by User with id: '.$user->getUsername());  
}  
/////////////////Script Ajax
$salleAjax = $this->getDoctrine()->getManager()->getRepository(Salle::class)->findAll();
if ($request->isXmlHttpRequest()) {  
  $jsonData = array();    
  return new JsonResponse($jsonData); 

} else { 
  return $this->render('reservation/listReservation.html.twig'); 
}

}
  /**
   * Permet de reserver une salle
   * 
   * @Route("/reservation_Annuler/{id}", name="app_reservation1")
   * @return Response
   */
  public function reservationAnnuler($id): Response
  {
    $user = $this->getUser();
  
    $repository = $this->getDoctrine()->getRepository(User::class);
    $userConnect=$repository->find(['id'=>$user->getId()]);
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
     
      // return new Response(
      //   'Reservartion annulé id: '.$reservation->getId()
      //   .'de la salle id: '.$salle->getId().' by User with id: '.$user->getUsername());
        return $this->redirectToRoute('reservation'); 
 }
  //return $this->redirectToRoute('reservation');
}


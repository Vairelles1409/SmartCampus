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
//   public function reservationEffectuer($id,$user_id,$periode_id): Response
//   {
//     $salle= new Salle();
//     $idReservation=new Reservation();
    
//     $salle = $this->getDoctrine()->getManager()->getRepository(Salle::class)->find($id);
//     $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($user_id);
//     $periode = $this->getDoctrine()->getManager()->getRepository(Periode::class)->find($periode_id);

//         $etat=$salle->getEtat();
//         if($etat=='libre'){
//         $salle->setEtat('reservé') ;
//         $em = $this->getDoctrine()->getManager();
//         $em->persist($salle);
//         $em->flush();
//         /////////////////////////////////////
//         /** @var User $user */
//         /** @var Periode $periode */
//         $idReservation->setUser($user);
//         $idReservation->setSalle($id);
//         $idReservation->setPeriode($periode);
//         $em = $this->getDoctrine()->getManager();
//         $em->persist($idReservation);
//         $em->flush();
//     }
//       return $this->redirectToRoute('reservation');
//  }

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
  $user= new User();
  $user = $this->getUser();
  $repository = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id'=> $user->getId()]);
  ////////////////Recherche de la periode choisi
  
//////////////////Création de la nouvelle reservation
  $reservation= new Reservation();
  $salleReserver=$salle;
  $reservation->setSalle($salleReserver);
  $reservation->setUser($repository);
  
  $entityManager = $this->getDoctrine()->getManager();
  $entityManager->persist($reservation);
  //$entityManager->persist($reservation);
  $entityManager->flush();
  return new Response(
    'Saved new Reservation with id: '.$reservation->getId()
    .' and new Salle with id: '.$salle->getId().' for User with id: '.$user->getUsername()

);
}
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


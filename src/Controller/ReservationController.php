<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Salle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="app_reservation")
     */
    public function reservation(): Response
    {
        $registration = $this->getDoctrine()->getManager()->getRepository(Salle::class)->findAll();
        $registration2 = $this->getDoctrine()->getManager()->getRepository(Reservation::class)->findAll();
        return $this->render('reservation/listReservation.html.twig', [
            "b"=>$registration,
            "b1"=>$registration2
        ]);
    }

    /**
     * @Route("/reservation2", name="app_reservation")
     */
    // public function reservation2(): Response
    // {
    //     $registration = $this->getDoctrine()->getManager()->getRepository(Reservation::class)->findAll();
    //     return $this->render('reservation/listReservation.html.twig', [
    //         "b"=>$registration,
    //     ]);
    // }
}

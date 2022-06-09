<?php

namespace App\Controller;

use App\Entity\Periode;
use App\Entity\Reservation;
use App\Repository\PeriodeRepository;
use App\Entity\Salle;
use App\Form\ReservationType;
use App\Form\SalleType;
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

        $id = new Periode();
        //$test=$id->getID();
        $salleReserver = $this->getDoctrine()->getManager()->getRepository(Salle::class)->findAll();
       // $periode = $this->getDoctrine()->getManager()->getRepository(Periode::class)->findAll();
        $periode1 = $this->getDoctrine()->getManager()->getRepository(Periode::class)->findBy(['id'=>1]);
        $periode2 = $this->getDoctrine()->getManager()->getRepository(Periode::class)->findBy(['id'=>2]);
        $periode3 = $this->getDoctrine()->getManager()->getRepository(Periode::class)->findBy(['id'=>3]);
        // $VarName = $repo->findBy(['property'=>value]);

       
        // $periode= $em->SELECT('periode.libelle')
        //              ->from('Bundlename: Periode','libelle')
        //              ->getQuery()
        //              ->getResult();

        //$periode= DB::table('periode')->select('libelle')->where('id', $id)->first();
        // $em = $this->container->get("");
        // $periode= $em->getRepository(Periode::class)->findBy([
        //     "id"=>$id,
        // ]);
        
        return $this->render('reservation/listReservation.html.twig', [
            "b"=>$salleReserver,
            "b1"=>$periode1,
            "b2"=>$periode2,
            "b3"=>$periode3
        ]);
    }

    public function gestionReservation(Request $resquest):Response{
        $reservartion = $this->getDoctrine()->getManager()->getRepository(Reservation::class)->findAll();
        if ($resquest->isXmlHttpRequest()){
            $jsondata= array();
            $index=0;
            foreach ($reservartion as $key => $reserver) {
                # code...
                $temp= array(
                    'statut' =>$reserver->getEtat(),
                );
                $jsondata[$index++]= $temp;
            }
            return new JsonResponse($jsondata);

        }else{
            return $this->render('reservation/listReservation.html.twig');
        }

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

    /**
     * @Route("/modifReservation/{id}", name="modif_reservation")
     */
    public function modifReservation(Request $request,$id): Response
    {
        $reservation = $this->getDoctrine()->getManager()->getRepository(Salle::class)->find($id);

        $form = $this->createForm(SalleType::class,$reservation);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('app_reservation');
        }
        return $this->render('reservation/listReservation.html.twig');

    }
}

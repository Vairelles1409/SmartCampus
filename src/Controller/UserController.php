<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    /**
     * @Route("/admin", name="display_admin")
     */
    public function indexAdmin(): Response
    {
        return $this->render('admin/index.html.twig');
    }

     /**
     * @Route("/adduser", name="add_user")
     */
    // public function addUser(Request $request): Response
    // {
    //     $user=new User();
    //     $formUser= $this->createForm(UserType::class,$user);

    //     $formUser->handleRequest($request);
        
    //     if ($formUser->isSubmitted() && $formUser->isValid()) { 
    //         $em= $this->getDoctrine()->getManager();
    //         $em->persist($user); //Utilisateur ajouté
    //         $em->flush();

    //         return $this->redirectToRoute('app_user');
    //     }
    //     return $this->render('user/user.html.twig',[
    //         'f'=>$formUser->createView()
    //     ]);
    // }
}

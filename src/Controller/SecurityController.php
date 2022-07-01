<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="app_security")
     */
    public function index(): Response
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
        $user= new User();
        if($user->getRoles()==['ROLE_USER']){
            return $this->redirectToRoute('user/indexUser.html.twig');
        }
        else return $this->redirectToRoute('admin/index.html.twig');

    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): Response
    {
        // throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        return $this->redirectToRoute('login');

    }

    /**
     * @Route("/acceuil", name="app_logout")
     */
    public function acceuil(): Response
    {
        // throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        return $this->render('acceuil.html.twig');

    }
}

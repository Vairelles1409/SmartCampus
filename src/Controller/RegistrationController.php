<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     *  @Route("/listUser", name="display_user")
     */
   public function index()
   {

       $user = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
       return $this->render('user/listUser.html.twig', [
           "b"=>$user,
       ]);
   }

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/adduser", name="add_user")
     */
    public function add_User(Request $request): Response
    {
        $user = new User();

       $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the new users password
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

            // Set their role
            $user->setRoles(['ROLE_USER']);

            // Save
            $em = $this->getDoctrine()->getManager();
            //var_dump($user);}
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('registration/registration.html.twig', [
            'form_title'=> 'Nouvel Utilisateur',
            'form' => $form->createView(),
        ]);
        
    }

    /**
     * @Route("/removeUser/{id}", name="supp_user")
     */
    public function suppressionUser(User $user): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('display_user');


    }

    /**
     * @Route("/modifUser/{id}", name="modif_user")
     */
    public function modifUser(Request $request,$id): Response
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($id);

        $form = $this->createForm(UserType::class,$user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('display_user');
        }
        return $this->render('user/updateUser.html.twig',[
            'form_title'=> 'Nouvel Utilisateur',
        'form'=>$form->createView()]);




    }
    
}
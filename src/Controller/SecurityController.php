<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Agent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="app_login", methods={"GET","POST"})
     */
    public function index(): Response
    {
        return $this->render('security/login.html.twig', 
        [
           
        ]);
    }

    /**
     * @Route("/register", name="app_register", methods={"GET","POST"})
     */
    public function register(Request $request, EntityManagerInterface $em, User $user = null, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $agents = $this->getDoctrine()->getRepository(Agent::class)->findAll();
        if (!$user) {
            $user = new User;
        }
        $form=$this->createFormBuilder($user)
                        ->add('email')
                        //->add('roles')
                        ->add('plainPassword',RepeatedType::class, [
                                'mapped' => false,
                                'type' => PasswordType::class,
                                'invalid_message' => 'Les mot de passe diffèrent',
                                'options' => ['attr' => ['class' => 'password-field']],
                                'required' => true,
                                'first_options'  => ['label' => 'Mot de passe'],
                                'second_options' => ['label' => 'Confirmation du mot de passe'],
                                'constraints' => [
                                    new NotBlank,
                                    new Length(['min'=>6,'max'=> 4096]),
                                ]
                            ])
                        ->add('agent',EntityType::class,['class' => Agent::class,'choice_label' => 'nom', 'attr' => ['class' => 'select-chosen']])
                        ->getForm();



        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            
            $user->setRoles(["ROLE_SECRETARY"]);
            $user->setPassword($passwordEncoder->encodePassword($user, $form['plainPassword']->getData()));
            $em->persist($user);
            $em->flush();
            
            // $this->addFlash("success","Utilisateur créé avec succès");

            return $this->redirectToRoute('app_login'); 
        }
        
        return $this->render('security/register.html.twig',
                    [
                        'agents' => $agents,
                        'form' => $form->createView(),
                    ]
        );
    }

    /**
     * @Route("/", name="app_login" , methods={"GET","POST"})
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
             return $this->redirectToRoute('dashboard');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

}
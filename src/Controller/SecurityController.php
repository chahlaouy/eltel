<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\TypeNumero;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\Palier;

class SecurityController extends AbstractController{


    /**
    * @Route("/connexion", name="login")
    */
    public function login(AuthenticationUtils $authUtils){

        $error = $authUtils->getLastAuthenticationError();
        $lastUserName = $authUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_name' => $lastUserName,
            'error' => $error
        ]);
    }

     /**
     * @Route("/panel", name="panel")
     */
    public function panel(AuthenticationUtils $authUtils){

        $error = $authUtils->getLastAuthenticationError();
        $lastUserName = $authUtils->getLastUsername();
        return $this->render('admin/admin.html.twig', [
                'last_name' => $lastUserName,
                'error' => $error
            ]);
    }

    /**
     * @Route("/inscription", name="register")
     */
    public function register(ValidatorInterface $validator, Request $request, UserPasswordEncoderInterface $userEncoder){


        $entityManager = $this->getDoctrine()->getManager();
        $repoType = $this->getDoctrine()->getRepository(TypeNumero::class);
        $repoPalier = $this->getDoctrine()->getRepository(Palier::class);
        $types = $repoType->findAll();

        $user = new User();

        if ($request->request->count() > 0){

            $palier = $repoPalier->find($request->request->get('palier'));
            $typeNum = $repoType->find($request->request->get('type-numero'));



            $user->setUserName($request->request->get('username'))
                ->setEmail($request->request->get('email'))
                ->setPassword($request->request->get('password'))
                ->setConfirmPaswword($request->request->get('confirm-password'))
                ->setAdresse($request->request->get('adresse'))
                ->setCp($request->request->get('cp'))
                ->setPhone($request->request->get('tel'))
                ->setSociete($request->request->get('societe'))
                ->setVille($request->request->get('ville'))
                ->setSiren($request->request->get('siren'))
                ->setVerified(false)
                ->setPalier($palier)
                ->setTypNumero($typeNum)
                ->setCreatedAt(new \DateTime());
            
            $errors = $validator->validate($user);
            
            if (count($errors) > 0) {
                return $this->render('security/register.html.twig', [
                    'types' => $types,
                    'errors'    =>  $errors
                ]);
            }else{
                $hash = $userEncoder->encodePassword($user, $user->getPassword());
                $user->setPassword($hash);
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('home');
            }
        }

       
        return $this->render('security/register.html.twig', [
            'types' => $types
        ]);
    }
    /**
    * @Route("/logout", name="logout")
    */
    public function logout(){

        return $this->redirectToRoute('home');
    }
}
/*
                * Uses a __toString method on the $errors variable which is a
                * ConstraintViolationList object. This gives us a nice string
                * for debugging.
                */
 // $form = $this->createForm(RegistrationType::class, $user);
        // dump($request->request);
        // $form->handleRequest($request);

        // if( $form->isSubmitted() && $form->isValid()){

        //     $hash = $userEncoder->encodePassword($user, $user->getPassword());
        //     $user->setPassword($hash);
        //     $entityManager->persist($user);
        //     $entityManager->flush();
        //     return $this->redirectToRoute('login');
        // }
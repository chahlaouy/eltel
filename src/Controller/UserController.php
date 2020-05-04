<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Identity;

class UserController extends AbstractController
{
    /**
     * @Route("/mon-espace", name="espace")
     */
    public function index()
    {
        $identity = new Identity();

        $form = $this->createForm(RegistrationType::class, $identity, [
            'action' => $this->generateUrl('verif'),
            'method' => 'POST',
        ]);
        return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
            'dashboard' => 'active'
        ]);
        
    }
    /**
     * @Route("/reversement", name="reversement")
     */
    public function reversement()
    {  
        return $this->render('user/reversement.html.twig', [
            'reverse'   => 'active'
        ]);
        
    }
    /**
     * @Route("/profile", name="profile")
     */
    public function profile()
    {  
        return $this->render('user/profile.html.twig', [
            'profil'   => 'active'
        ]);
        
    }
    
    /**
     * @Route("/verif", name="verif")
     */
    public function verif(Request $request)
    {
        $identity = new Identity();

        $form = $this->createForm(RegistrationType::class, $identity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $identity = $form->getData();

            $user = $this->getUser();
            $identity->setUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($identity);
            $entityManager->flush();

            return $this->redirectToRoute('espace');
        }

        return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
// $user = $this->getUser();
//         dd($user->getUserIdentity()->getIdentity());

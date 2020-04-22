<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController {

   
    /**
     * @Route("/", name="home")
     */
    public function index() :Response{

        
        return $this->render('home.html.twig', [
            'home' => 'active',
        ]);
    }
    /**
     * @Route("/offre", name="offre")
     */
    public function pageOffre() :Response{

        
        return $this->render('offre.html.twig', [
            'offre' => 'active',
        ]);
    }
    /**
     * @Route("/test", name="test")
     */
    public function test() :Response{

        
        return $this->render('test.html.twig', [
            'offre' => 'active',
        ]);
    }
}
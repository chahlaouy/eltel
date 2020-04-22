<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }
    /**
     * @Route("/clients", name="clients")
     */
    public function getClients()
    {
        $repo = $this->getDoctrine()->getRepository(User::class);

        $clients = $repo->findAll();
        return $this->render('admin/clients.html.twig', [
            'clients'   =>  $clients
        ]);
    }
}

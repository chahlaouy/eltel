<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\NumeroSurtaxe;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * @Route("/panel/dashboard", name="dashboard")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'dashboard' => 'active'
        ]);
    }
    /**
     * @Route("/panel/clients", name="clients")
     */
    public function getClients()
    {
        $repo = $this->getDoctrine()->getRepository(User::class);

        $clients = $repo->findByVerified(true);
        return $this->render('admin/clients.html.twig', [
            'clients'   =>  $clients,
            'clts'      => 'active'
        ]);
    }
    /**
     * @Route("/panel/demande", name="demande")
     */
    public function getDemands()
    {
        $repo = $this->getDoctrine()->getRepository(User::class);

        $clients = $repo->findByVerified(false);
        return $this->render('admin/demande.html.twig', [
            'clients'   =>  $clients,
            'demande'   => 'active'
        ]);
    }
    /**
     * @Route("/panel/consommation", name="consommation")
     */
    public function getConsommation()
    {
        $repo = $this->getDoctrine()->getRepository(NumeroSurtaxe::class);

        $numeros = $repo->findAll();
        return $this->render('admin/consommation.html.twig', [
            'numeros'   =>  $numeros,
            'consommation'   => 'active'
        ]);
    }
    /**
     * @Route("/panel/change-consommation/{id}", name="change.consommation")
     */
    public function changeConsommation(NumeroSurtaxe $numero, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(NumeroSurtaxe::class);

        $numeros = $repo->findAll();

        if ($request->request->count() > 0){
            
            $numero->setConsommation($request->request->get('consommation'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($numero);
            $entityManager->flush();

        }
        // return $this->render('admin/consommation.html.twig', [
        //     'numeros'   =>  $numeros,
        //     'consommation'   => 'active'
        // ]);
        return $this->redirectToRoute('consommation');

    }
    /**
     * @Route("/panel/clients/{id}", name="client.edit")
     */
    public function getClient(User $client)
    {
        return $this->render('admin/client.html.twig', [
            'client'   =>  $client,
            'clts'      => 'active'
        ]);
    }
    /**
     * @Route("/panel/demande/{id}", name="demande.edit")
     */
    public function getDemand(User $client)
    {
        // $repo = $this->getDoctrine()->getRepository(User::class);

        // $clients = $repo->findByVerified(false);
        return $this->render('admin/show-demande.html.twig', [
            'client'   =>  $client,
            'demande'   => 'active'
        ]);
    }
    /**
     * @Route("/panel/valid-account/{id}", name="valid.account")
     */
    public function validAccount(User $client)
    {
        $client->setVerified(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($client);
        $entityManager->flush();
        return $this->redirectToRoute('clients');
    }
    /**
     * @Route("/panel/affect-number/{id}", name="affect.number")
     */
    public function affectNumberToClient(User $client, ValidatorInterface $validator, Request $request)
    {
        // $repo = $this->getDoctrine()->getRepository(User::class);

        $numero = new NumeroSurtaxe();

        if ($request->request->count() > 0){
            // $client = $repo->findOneBy($request->request->get('client-id'));
            $numero->setNumero($request->request->get('numero'))
                    ->setConsommation(0)
                    ->setTypologie($request->request->get('typologie'))
                    ->setUser($client);
            $errors = $validator->validate($numero);
            if (count($errors) > 0) {
                return $this->render('admin/clients.html.twig', [
                    'errors'    =>  $errors
                ]);
            }else{
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($numero);
                $entityManager->flush();
                return $this->redirectToRoute('clients');
            }
        }
        
        return $this->redirectToRoute('clients');
    }
}

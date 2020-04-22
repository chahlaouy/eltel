<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Palier;
use App\Entity\TypeNumero;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Admin;

class UserFixture extends Fixture
{

    private $userEncoder;
    public function __construct(UserPasswordEncoderInterface $userEncoder){
        $this->userEncoder = $userEncoder;
    }
    public function load(ObjectManager $manager)
        {

            $type0 = new TypeNumero();
            $type1 = new TypeNumero();
            $type0 -> setType("A la Minute");
            $type1 -> setType("A l' appel");

            $manager->persist($type0);
            $manager->persist($type1);

            $palier = new Palier();
            $palier->setPalier(0.80);
            $palier->setType($type0);
            $manager->persist($palier);

            $palier = new Palier();
            $palier->setPalier(0.70);
            $palier->setType($type0);
            $manager->persist($palier);

            $palier = new Palier();
            $palier->setPalier(0.60);
            $palier->setType($type0);
            $manager->persist($palier);

            $palier = new Palier();
            $palier->setPalier(0.50);
            $palier->setType($type0);
            $manager->persist($palier);

            $palier = new Palier();
            $palier->setPalier(0.40);
            $palier->setType($type0);
            $manager->persist($palier);


            $palier = new Palier();
            $palier->setPalier(3.00);
            $palier->setType($type1);
            $manager->persist($palier);

            $palier = new Palier();
            $palier->setPalier(2.99);
            $palier->setType($type1);
            $manager->persist($palier);

            $palier = new Palier();
            $palier->setPalier(2.55);
            $palier->setType($type1);
            $manager->persist($palier);

            $palier = new Palier();
            $palier->setPalier(2.00);
            $palier->setType($type1);
            $manager->persist($palier);

            $palier = new Palier();
            $palier->setPalier(1.99);
            $palier->setType($type1);
            $manager->persist($palier);

            $palier = new Palier();
            $palier->setPalier(1.50);
            $palier->setType($type1);
            $manager->persist($palier);
            $user = new Admin();
            $user->setUserName('muhamed');
            $user->setEmail('muhamed@me.com');
            $user->setPassword($this->userEncoder->encodePassword($user, '1234'));
            $manager->persist($user);
            
            $manager->flush();



    //     $user = new User();
    //     $user->setUserName('nour');
    //     $user->setEmail('nour@me.com');
    //     $user->setPassword($this->userEncoder->encodePassword($user, 'nour'));

    //     $manager->persist($user);
    //     $user = new User();
    //     $user->setUserName('muhamed');
    //     $user->setEmail('muhamed@me.com');
    //     $user->setPassword($this->userEncoder->encodePassword($user, 'muhamed'));

    //     $manager->persist($user);
    //     $manager->flush();
        }
}

<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
        private $passwordHasher;
    
        public function __construct(UserPasswordHasherInterface $passwordHasher)
        {
            $this->passwordHasher= $passwordHasher;
        }
    
        public function load(ObjectManager $manager): void
        {
            $user = new User();
            $user->setRoles(array('ROLE_ADMIN'))
            ->setEmail('admin@admin.fr')
            ->setPassword($this->passwordHasher->hashPassword($user, 'admin'));

            $user2 = new User();
            $user2->setRoles(array('ROLE_USER'))
            ->setEmail('normal@normal.fr')
            ->setPassword($this->passwordHasher->hashPassword($user2, 'normal'));

            $manager->persist($user);

            $manager->persist($user2);
            $manager->flush();
        }
}

<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    protected $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setNom('LACROIX');
        $user->setPrenom('Sylvain');
        $user->setEmail('sylvainlacroix@protonmail.com');
        $encoded = $this->encoder->hashPassword($user, '123');
        $user->setPassword($encoded);
        $user->setRoles(['ROLE_USER']);

        $admin = new User();
        $encodedAdmin = $this->encoder->hashPassword($admin, '123');
        $admin->setNom('Durand')->setPrenom('Jacques')->setEmail('admin@gmail.com')
            ->setPassword($encodedAdmin)
            ->setRoles(['ROLE_ADMIN']);

        $employee = new User();
        $encodedEmployee = $this->encoder->hashPassword($employee, '123');
        $employee->setNom('Dupont')->setPrenom('Henri')->setEmail('employee@gmail.com')
            ->setPassword($encodedEmployee)
            ->setRoles(['ROLE_EMPLOYEE']);

        $manager->persist($user);
        $manager->persist($admin);
        $manager->persist($employee);

        $manager->flush();
    }
}

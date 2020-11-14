<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $passwordEncoder;

    /**
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('contact@florianrampin.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setSurname('Rampin');
        $user->setName('Florian');

        $password = "123456+";
        $encryptedPassword = $this->passwordEncoder->encodePassword($user, $password);

        $user->setPassword($encryptedPassword);

        $manager->persist($user);

        $manager->flush();
    }
}

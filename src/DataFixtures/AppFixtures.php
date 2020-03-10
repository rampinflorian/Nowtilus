<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('contact@florianrampin.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$P4dxISUTHNiIX9dv7x8xWQ$bfgEXklgEjBxehSDDsek7uLgTQR8pEDiHc0FgtRL+hE');
        $user->setSurname('Rampin');
        $user->setName('Florian');
        $manager->persist($user);

        $manager->flush();
    }
}

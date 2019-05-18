<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{
    private $userPasswordEncoder;

    function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setUsername('admin');
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, '123456'));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFullname("Ahad Noor Alam");
        $user->setEmail("ahad@test.com");
        $manager->persist($user);
        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\UserRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture
{
    public const USER_ADMIN = "admin";
    private $encoder;
    private $connection;

    public function __construct(UserPasswordEncoderInterface $encoder, Connection $connection)
    {
        $this->encoder = $encoder;
        $this->connection = $connection;
    }

    public function load(ObjectManager $manager)
    {
        $this->connection->exec("ALTER TABLE users AUTO_INCREMENT = 1;");

        $user = new User();
        $user->setUsername(self::USER_ADMIN);
        $user->setFirstName("Aref");
        $user->setLastName("Razavi");
        $user->setEmail("admin@admin.com");
        $plainPassword = self::USER_ADMIN;
        $encodedPassword = $this->encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);
        $user->setIsActive(1);
        $roles = ['ROLE_SUPER_ADMIN'];
        $user->setRoles($roles);

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::USER_ADMIN, $user);

    }

}

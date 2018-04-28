<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserFixtures
 *
 * @package App\DataFixtures
 */
class UserFixtures extends Fixture
{
    /** @var UserPasswordEncoderInterface */
    private $encoder;

    /**
     * UserFixtures constructor.
     *
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $users = [
            'member' => [
                'email' => 'synthaxerreur@gmail.com',
                'rank' => 'ROLE_USER'
            ],
            'moderator' => [
                'email' => 'yogsothoth1337@gmail.com',
                'rank' => 'ROLE_MODO'
            ],
            'administrator' => [
                'email' => 'criticalerreur@gmail.com',
                'rank' => 'ROLE_ADMIN'
            ],
            'XenoX' => [
                'email' => 'xenox@gmail.com',
                'rank' => 'ROLE_KAIO'
            ]
        ];

        foreach ($users as $key => $data) {
            $user = $this->createUser($key, $data);
            $manager->persist($user);
            $this->setReference($key, $user);
        }

        $manager->flush();
    }

    /**
     * @param $key
     * @param $data
     *
     * @return User
     */
    private function createUser($key, $data)
    {
        $user = new User();

        $user
            ->setUsername(\ucfirst($key))
            ->setEmail($data['email'])
            ->setRoles(array($data['rank']))
            ->setPassword($this->encoder->encodePassword($user, 'panda'))
            ->setActivated(true)
        ;

        return $user;
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Team;
use App\Entity\TeamMember;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TeamAndTeamMemberFixtures
 *
 * @package App\DataFixtures
 */
class TeamAndTeamMemberFixtures extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $datas = [
            ['Dream Team', 'League Of Legends', 'Superbe Team qui déchire',
                [
                    ['XenoX', 'Mid', 'XenoX_', null],
                    ['Arthur', 'Jungle', null, null],
                    ['Neko', 'Support', null, 'Nekophilia'],
                    ['Yodjimbo', 'ADC', null, null],
                    ['Maverick', 'Top', 'Maverick', 'Maverick']
                ]
            ],
            ['Pantoufle sur le front', 'Hearthstone', 'Team Officiel HS',
                [
                    ['XenoX', null, 'XenoX_', null],
                    ['Arthur', null, null, null]
                ]
            ]
        ];

        foreach ($datas as $data) {
            $entity = $this->createObjects($data);
            $manager->persist($entity);
        }

        $manager->flush();
    }

    /**
     * @param $data
     *
     * @return Team
     */
    private function createObjects($data)
    {
        $team = new Team();

        $team
            ->setName($data[0])
            ->setGame($data[1])
            ->setDescription($data[2])
        ;

        foreach ($data[3] as $value) {
            $teamMember = new TeamMember();

            $teamMember
                ->setName($value[0])
                ->setPosition($value[1])
                ->setTwitter($value[2])
                ->setFacebook($value[3])
                ->setTeam($team)
            ;

            $team->addMember($teamMember);
        }

        return $team;
    }
}

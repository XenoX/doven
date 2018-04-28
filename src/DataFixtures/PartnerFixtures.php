<?php

namespace App\DataFixtures;

use App\Entity\Partner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class PartnerFixtures
 *
 * @package App\DataFixtures
 */
class PartnerFixtures extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $datas = [
            [
                'Tournois Legend', 'http://www.tournois-legend.com/', 'TournoisLegend', 'TournoisLegend',
                'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores sequi fugiat id a consequuntur nesciunt vero, mollitia accusamus! Dolorem magni explicabo quas molestias labore, suscipit animi velit saepe commodi similique.'
            ],
            [
                'Entre-Geeks', 'http://www.entre-geeks.com/', 'EntreGeeks', null,
                'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit tempore illo distinctio, voluptatem consequatur aspernatur repellat iste facilis dignissimos enim qui repudiandae eum, alias tempora accusantium assumenda. Suscipit animi, dolorem.'
            ],
            ['Millenium', 'http://www.millenium.com/', null, 'Millenium', null]
        ];

        foreach ($datas as $data) {
            $entity = $this->createObject($data);
            $manager->persist($entity);
        }

        $manager->flush();
    }

    /**
     * @param $data
     *
     * @return Partner
     */
    private function createObject($data)
    {
        $object = new Partner();

        $object
            ->setName($data[0])
            ->setWebsite($data[1])
            ->setTwitter($data[2])
            ->setFacebook($data[3])
            ->setDescription($data[4])
        ;

        return $object;
    }
}

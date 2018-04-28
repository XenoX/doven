<?php

namespace App\DataFixtures;

use App\Entity\Stream;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class StreamFixtures
 *
 * @package App\DataFixtures
 */
class StreamFixtures extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $datas = [
            ['Tournois Legend', 'esl_tournoislegend'],
            ['Millenium HS', 'milleniumtvhs'],
            ['Fureur', 'fureurtv'],
            ['Santosvella', 'santosvella']
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
     * @return Stream
     */
    private function createObject($data)
    {
        $object = new Stream();

        $object
            ->setName($data[0])
            ->setTwitch($data[1])
        ;

        return $object;
    }
}

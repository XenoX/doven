<?php

namespace App\DataFixtures;

use App\Entity\Carousel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class CarouselFixtures
 *
 * @package App\DataFixtures
 */
class CarouselFixtures extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $datas = [
            ['Carousel 1', 'Text du carousel numéro 1'],
            ['Carousel 2', 'Text du carousel numéro 2'],
            ['Carousel 3', 'Text du carousel numéro 3']
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
     * @return Carousel
     */
    private function createObject($data){
        $object = new Carousel();

        $object
            ->setTitle($data[0])
            ->setContent($data[1])
        ;

        return $object;
    }
}

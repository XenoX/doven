<?php

namespace App\DataFixtures;

use App\Entity\News;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class NewsFixtures
 *
 * @package App\DataFixtures
 */
class NewsFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $datas = [
            [
                'Super News de folie',
                '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores veniam laudantium et tempore nobis ducimus voluptatem totam, <b>provident</b> eveniet quidem numquam atque vitae voluptatibus est cumque, quas expedita. Quos, accusamus.</p>'
            ],
            [
                'Énorme News !!',
                '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores veniam laudantium et tempore nobis ducimus voluptatem totam, provident eveniet quidem numquam atque vitae voluptatibus est cumque, quas expedita. Quos, accusamus.</p>'
            ],
            [
                'Blabla c\'est génial',
                '<p>Lorem ipsum <i>dolor</i> sit amet, consectetur adipisicing elit. Asperiores veniam laudantium et tempore nobis ducimus voluptatem totam, provident eveniet quidem numquam atque vitae voluptatibus est cumque, quas expedita. Quos, accusamus.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam officia ratione aliquam id eius distinctio atque labore molestias. Sed libero veniam optio fugit eum, enim ea dolorum illum quisquam incidunt!</p>'
            ],
            [
                'News qui trou le cul',
                '<p>Lorem ipsum dolor <span class="text-success">sit amet</span>, consectetur adipisicing elit. Asperiores veniam laudantium et tempore nobis ducimus voluptatem totam, provident eveniet quidem numquam atque vitae voluptatibus est cumque, quas expedita. Quos, accusamus.</p>'
            ],
            [
                'Vive les courgettes',
                '<p>Lorem ipsum dolor sit amet, <b>consectetur</b> adipisicing elit. Asperiores veniam laudantium et tempore nobis ducimus voluptatem totam, provident eveniet quidem numquam atque vitae voluptatibus est cumque, quas expedita. Quos, accusamus.</p>'
            ],
            [
                'J\'ai une queue de cheval mais je suis chauve', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores veniam laudantium et tempore nobis ducimus <b>voluptatem totam</b>, provident eveniet quidem numquam atque vitae voluptatibus est cumque, quas expedita. Quos, accusamus.</p>'
            ]
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
     * @return News
     */
    private function createObject($data)
    {
        $object = new News();

        /** @var User $member */
        $member = $this->getReference('member');

        $object
            ->setTitle($data[0])
            ->setDescription($data[0])
            ->setContent($data[1])
            ->setUpdatedAt(new \DateTime())
            ->setUser($member)
        ;

        return $object;
    }

    /**
     * {@inheritdoc}
     */
    function getDependencies()
    {
        return [UserFixtures::class];
    }
}

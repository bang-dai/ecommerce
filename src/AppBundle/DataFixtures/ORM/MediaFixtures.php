<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MediaFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $media = new Media();
            $media->setAlt('media'.$i);
            $media->setPath('https://generationyllea.files.wordpress.com/2013/06/pomme.jpg');
            $manager->persist($media);
            $this->addReference('media'.$i, $media);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return parent::getDependencies();
    }
}

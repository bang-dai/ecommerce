<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $category1 = new Category();
        $category1->setName('Fruits');
        $category1->setImage($this->getReference('media1'));

        $category2 = new Category();
        $category2->setName('Légumes');
        $category2->setImage($this->getReference('media2'));

        $manager->persist($category1);
        $manager->persist($category2);
        $manager->flush();

        $this->addReference('category1', $category1);
        $this->addReference('category2', $category2);
    }

    public function getDependencies()
    {
        return array(
            MediaFixtures::class
        );
    }
}

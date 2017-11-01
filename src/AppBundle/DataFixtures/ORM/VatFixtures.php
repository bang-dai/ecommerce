<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use AppBundle\Entity\Vat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VatFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $vat1 = new Vat();
        $vat1->setMultiplicate(0.982);
        $vat1->setName('TVA 1.75%');
        $vat1->setValue(1.75);

        $vat2 = new Vat();
        $vat2->setMultiplicate(0.833);
        $vat2->setName('TVA 20%');
        $vat2->setValue(20.0);

        $manager->persist($vat1);
        $manager->persist($vat2);
        $manager->flush();

        $this->addReference('vat1', $vat1);
        $this->addReference('vat2', $vat2);
    }

    public function getDependencies()
    {
        return parent::getDependencies();
    }
}

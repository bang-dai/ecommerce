<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AddressFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $address = new Address();
            $address->setUser($this->getReference('user'.$i));
            $address->setName('nom'.$i);
            $address->setFirstname('prenom'.$i);
            $address->setAddress('1 rue albert thomas');
            $address->setAddress2('face à l\'église');
            $address->setCp('75000');
            $address->setCity('Paris');
            $address->setCountry('France');
            $address->setTel('0144556677');
            $manager->persist($address);
            $this->setReference('address'.$i, $address);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class
        );
    }
}

<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Address;
use AppBundle\Entity\Orders;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class OrderFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $order = new Orders();
            $order->setUser($this->getReference('user'.$i));
            $order->setValid(true);
            $order->setDate(new \DateTime());
            $order->setReference($i);
            $order->setProducts(array(
                $this->getReference('product'.$i)->getId() => 1
            ));
            $manager->persist($order);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            ProductFixtures::class
        );
    }
}

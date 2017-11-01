<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\Vat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setImage($this->getReference('media'.$i));
            $product->setName('Pomme'.$i);
            $product->setAvailable(true);
            $product->setCategory($this->getReference('category1'));
            $product->setDescription('Un beau fruit avant de devenir une marque');
            $product->setPrice(1.0);
            $product->setVat($this->getReference('vat2'));
            $manager->persist($product);

            $this->setReference('product'.$i, $product);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            VatFixtures::class,
            MediaFixtures::class,
            CategoryFixtures::class
        );
    }
}

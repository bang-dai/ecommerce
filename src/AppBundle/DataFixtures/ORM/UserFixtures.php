<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Media;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername('user'.$i);
            $user->setEmail('user'.$i.'@domain.com');
            $user->setEnabled(true);
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($user, 'user');
            $user->setPassword($password);
            $manager->persist($user);
            $this->setReference('user'.$i, $user);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return parent::getDependencies();
    }
}

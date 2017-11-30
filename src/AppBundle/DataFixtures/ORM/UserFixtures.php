<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
	public function load(ObjectManager $manager)
	{
        for ($i = 1; $i <= 50; $i++) {
            $user= new User();
            $user->setUsername('admin'.$i);
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($user, '12345');
            $user->setPassword($password);
            $user->setEmail('thuonghtml@gmail.com');
            $user->setRole('ROLE_ADMIN');
            $manager->persist($user);
            $manager->flush();
        }

		
    	$user1= new User();
		$user1->setUsername('thuonghtml');
    	$password1 = $encoder->encodePassword($user1, '12345');
    	$user1->setPassword($password1);
    	$user1->setEmail('thuonghtml@gmail.com');
    	$user1->setRole('ROLE_USER');
    	$manager->persist($user1);
    	$manager->flush();
	}
}
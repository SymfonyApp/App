<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\LoaiSP;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoaiSPFixtures extends Fixture
{
	public function load(ObjectManager $manager)
	{
        for ($i = 1; $i <= 5; $i++) {
            $loai= new LoaiSP();
            $loai->setTenloai('loai'.$i);
         
            $manager->persist($loai);
            $manager->flush();
        }
	}
}
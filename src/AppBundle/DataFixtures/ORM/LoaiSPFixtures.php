<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\LoaiSP;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoaiSPFixtures extends Fixture
{
	public function load(ObjectManager $manager)
	{
        
            $loai1= new LoaiSP();
            $loai1->setTenloai('Breakfast');
         	$loai2= new LoaiSP();
            $loai2->setTenloai('Lunch');
         	$loai3= new LoaiSP();
            $loai3->setTenloai('Dinner');
         	$loai4= new LoaiSP();
            $loai4->setTenloai('Drink');
            $manager->persist($loai1);
            $manager->persist($loai2);
            $manager->persist($loai3);
            $manager->persist($loai4);
            $manager->flush();
        
	}
}
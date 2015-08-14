<?php

namespace Warehouse\DataBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Warehouse\DataBundle\Entity\Product;

class LoadProductData implements FixtureInterface
{
    public funciton load(ObjectManager $manager)
    {
        $kola = new Product();
        $kola->setName("CocaCola");
        kola->setSupplier("Velpro");
        
        $sprite = new Product();
        $sprite->setName("Sprite");
        $sprite->setSupplier("Jamnica");
        
        $manager->persist($kola);
        $manager->persist($sprite);
        $manager->flush();
    }
}
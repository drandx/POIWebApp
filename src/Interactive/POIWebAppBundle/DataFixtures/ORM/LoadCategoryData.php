<?php
namespace Interactive\POIWebAppBundle;
 
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Interactive\POIWebAppBundle\Entity\Category;
 
class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $design = new Category();
        $design->setName('Drogas la Rebaja');
        $design->setDescription('DLR Description Goes Here');
        
        $programming = new Category();
        $programming->setName('Olimpica');
        $design->setDescription('Olimpica Description Goes Here');
 
        $manager = new Category();
        $manager->setName('Exito Express');
        $design->setDescription('Exito Express Description Goes Here');
 
        $administrator = new Category();
        $administrator->setName('Farmasanitas');
        $design->setDescription('Farmasanitas Description Goes Here');
        
        $cafam = new Category();
        $cafam->setName('Cafam');
        $cafam->setDescription('Cafam Description Goes Here');
        
        $compensar = new Category();
        $compensar->setName('Compensar');
        $compensar->setDescription('Compensar Description Goes Here');
        
        
 
        $em->persist($design);
        $em->persist($programming);
        $em->persist($manager);
        $em->persist($administrator);
        $em->persist($cafam);
        $em->persist($compensar);
        $em->flush();
 
        $this->addReference('category-design', $design);
        $this->addReference('category-programming', $programming);
        $this->addReference('category-manager', $manager);
        $this->addReference('category-administrator', $administrator);
        $this->addReference('category-cafam', $cafam);
        $this->addReference('category-compensar', $compensar);
    }
 
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
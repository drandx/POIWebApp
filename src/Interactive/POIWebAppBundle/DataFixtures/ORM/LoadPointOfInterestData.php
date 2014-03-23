<?php
namespace Interactive\POIWebAppBundle;
 
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Interactive\POIWebAppBundle\Entity\PointOfInterest;

class LoadPointOfInterestData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $poi_webapp_1 = new PointOfInterest();
        $poi_webapp_1->setLatitude("6.245040");
        $poi_webapp_1->setLongitude("-75.583035");
        $poi_webapp_1->setDescription("Descripcion punto 1");
        $poi_webapp_1->setAddress("Direccion punto 1");
        $poi_webapp_1->setCategory($em->merge($this->getReference('category-programming')));
        $poi_webapp_1->setCreatedAt(new \DateTime());
        $poi_webapp_1->setIsActivated(true);
        
        $poi_webapp_2 = new PointOfInterest();
        $poi_webapp_2->setLatitude("6.245744");
        $poi_webapp_2->setLongitude("-75.575074");
        $poi_webapp_2->setDescription("Descripcion punto 2");
        $poi_webapp_2->setAddress("Direccion punto 2");
        $poi_webapp_2->setCategory($em->merge($this->getReference('category-design')));
        $poi_webapp_2->setCreatedAt(new \DateTime());
        $poi_webapp_2->setIsActivated(true);
        
        $poi_webapp_3 = new PointOfInterest();
        $poi_webapp_3->setLatitude("6.243760");
        $poi_webapp_3->setLongitude("-75.575589");
        $poi_webapp_3->setDescription("Descripcion punto 3");
        $poi_webapp_3->setAddress("Direccion punto 3");
        $poi_webapp_3->setCategory($em->merge($this->getReference('category-manager')));
        $poi_webapp_3->setCreatedAt(new \DateTime());
        $poi_webapp_3->setIsActivated(true);
        
        $em->persist($poi_webapp_1);
        $em->persist($poi_webapp_2);
        $em->persist($poi_webapp_3);
       
        $em->flush();
        
    }
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}

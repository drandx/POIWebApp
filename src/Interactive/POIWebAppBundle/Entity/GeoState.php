<?php

namespace Interactive\POIWebAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoState
 */
class GeoState
{
    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Interactive\POIWebAppBundle\Entity\GeoCountry
     */
    private $geocountry;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return GeoState
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set geocountry
     *
     * @param \Interactive\POIWebAppBundle\Entity\GeoCountry $geocountry
     * @return GeoState
     */
    public function setGeocountry(\Interactive\POIWebAppBundle\Entity\GeoCountry $geocountry = null)
    {
        $this->geocountry = $geocountry;

        return $this;
    }

    /**
     * Get geocountry
     *
     * @return \Interactive\POIWebAppBundle\Entity\GeoCountry 
     */
    public function getGeocountry()
    {
        return $this->geocountry;
    }
}

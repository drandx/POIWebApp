<?php

namespace Interactive\POIWebAppBundle\Entity;

/**
 * GeoCity
 */
class GeoCity
{
    /**
     * @var integer
     *
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }


    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }


    public function __toString()
    {
        return $this->getName() ? $this->getName() : "";
    }
    
     /**
     * @var \Interactive\POIWebAppBundle\Entity\GeoState
     */
    public $geostate;
    
    /**
     * Set geostate
     *
     * @param \Interactive\POIWebAppBundle\Entity\GeoState $state
     * @return GeoCity
     */
    public function setGeostate(\Interactive\POIWebAppBundle\Entity\GeoState $geostate = null)
    {
        $this->geostate = $geostate;

        return $this;
    }

    /**
     * Get geostate
     *
     * @return \Interactive\POIWebAppBundle\Entity\GeoState 
     */
    public function getGeostate()
    {
        return $this->geostate;
    }



}

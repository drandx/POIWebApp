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
    public $id;

    /**
     * @var string
     *
     */
    public $name;

    /**
     * @var integer
     */
    public $idCountry;
    
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getIdCountry() {
        return $this->idCountry;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setIdCountry($idCountry) {
        $this->idCountry = $idCountry;
    }




}

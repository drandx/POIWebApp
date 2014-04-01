<?php

namespace Interactive\POIWebAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoState
 *
 * @ORM\Table(name="geo_states", indexes={@ORM\Index(name="fk_geo_estados_geo_paises1", columns={"id_country"})})
 * @ORM\Entity
 */
class GeoState
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    public $name;

    /**
     * @var \Interactive\POIWebAppBundle\Entity\GeoCountry
     *
     * @ORM\ManyToOne(targetEntity="Interactive\POIWebAppBundle\Entity\GeoCountry")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_country", referencedColumnName="id")
     * })
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

    public function setIdCountry(\Interactive\POIWebAppBundle\Entity\GeoCountry $idCountry) {
        $this->idCountry = $idCountry;
    }




}

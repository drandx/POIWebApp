<?php

namespace Interactive\POIWebAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoCity
 *
 * @ORM\Table(name="geo_cities", indexes={@ORM\Index(name="geo_states_id_state_idx", columns={"id_state"})})
 * @ORM\Entity
 */
class GeoCity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    private $name;

    /**
     * @var \Interactive\POIWebAppBundle\Entity\GeoState
     *
     * @ORM\ManyToOne(targetEntity="Interactive\POIWebAppBundle\Entity\GeoState")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_state", referencedColumnName="id")
     * })
     */
    private $idState;
    
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getIdState() {
        return $this->idState;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setIdState(\Interactive\POIWebAppBundle\Entity\GeoState $idState) {
        $this->idState = $idState;
    }




}

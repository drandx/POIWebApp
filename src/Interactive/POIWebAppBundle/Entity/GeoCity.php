<?php

namespace Interactive\POIWebAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoCity
 *
 * @ORM\Table(name="geo_cities", indexes={@ORM\Index(name="FK_geo_ciudades_1", columns={"id_estados"})})
 * @ORM\Entity
 */
class GeoCity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_ciudad", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCiudad;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=200, nullable=false)
     */
    private $nombre;

    /**
     * @var \Interactive\POIWebAppBundle\Entity\GeoStates
     *
     * @ORM\ManyToOne(targetEntity="Interactive\POIWebAppBundle\Entity\GeoStates")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estados", referencedColumnName="id_departamento")
     * })
     */
    private $idEstados;


}

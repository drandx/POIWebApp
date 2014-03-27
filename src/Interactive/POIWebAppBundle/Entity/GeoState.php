<?php

namespace Interactive\POIWebAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoState
 *
 * @ORM\Table(name="geo_states", indexes={@ORM\Index(name="fk_geo_estados_geo_paises1", columns={"id_pais"})})
 * @ORM\Entity
 */
class GeoState
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_departamento", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDepartamento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=200, nullable=false)
     */
    private $nombre;

    /**
     * @var \Interactive\POIWebAppBundle\Entity\GeoCountries
     *
     * @ORM\ManyToOne(targetEntity="Interactive\POIWebAppBundle\Entity\GeoCountries")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pais", referencedColumnName="id_pais")
     * })
     */
    private $idPais;


}

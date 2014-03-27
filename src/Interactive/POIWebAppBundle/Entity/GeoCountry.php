<?php

namespace Interactive\POIWebAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoCountry
 *
 * @ORM\Table(name="geo_countries")
 * @ORM\Entity
 */
class GeoCountry
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_pais", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPais;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=200, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=5, nullable=true)
     */
    private $codigo;


}

<?php

namespace Interactive\POIWebAppBundle\Entity;
use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;

/**
 * RoutePoint
 */
class RoutePoint implements JsonSerializable
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
     * @var string
     */
    private $latitude;

    /**
     * @var string
     */
    private $longitude;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \Interactive\POIWebAppBundle\Entity\Route
     */
    private $route;


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
     * @return RoutePoint
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
     * Set latitude
     *
     * @param string $latitude
     * @return RoutePoint
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return RoutePoint
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return RoutePoint
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return RoutePoint
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return RoutePoint
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set route
     *
     * @param \Interactive\POIWebAppBundle\Entity\Route $route
     * @return RoutePoint
     */
    public function setRoute(\Interactive\POIWebAppBundle\Entity\Route $route = null)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return \Interactive\POIWebAppBundle\Entity\Route 
     */
    public function getRoute()
    {
        return $this->route;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PrePersist
     */
    public function setIsActivatedVale()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        // Add your code here
    }
    
    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'name'=> $this->name,
            'latitude'=> $this->latitude,
            'longitude'=> $this->longitude,
            'route'=> $this->route,
            'IsOrigin'=> $this->isOrigin,
            'IsDestination'=> $this->isDestination,
        );
    }
    /**
     * @var int
     */
    private $isOrigin;

    /**
     * @var int
     */
    private $isDestination;


    /**
     * Set isOrigin
     *
     * @param \int $isOrigin
     * @return RoutePoint
     */
    public function setIsOrigin($isOrigin)
    {
        $this->isOrigin = $isOrigin;

        return $this;
    }

    /**
     * Get isOrigin
     *
     * @return \int 
     */
    public function getIsOrigin()
    {
        return $this->isOrigin;
    }

    /**
     * Set isDestination
     *
     * @param \int $isDestination
     * @return RoutePoint
     */
    public function setIsDestination($isDestination)
    {
        $this->isDestination = $isDestination;

        return $this;
    }

    /**
     * Get isDestination
     *
     * @return \int 
     */
    public function getIsDestination()
    {
        return $this->isDestination;
    }
    
     public function __toString()
    {
        $orDest = "";
        
        if($this->isOrigin)
            $orDest = " - Punto Inicial";
        else if($this->isDestination)
            $orDest = " - Punto Final";
        else
            $orDest = "";
        
        return $this->id . " - " . $this->name . $orDest;
    }
}

<?php

namespace Interactive\POIWebAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Route
 */
class Route
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
    private $description;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $route_points;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->route_points = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Route
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
     * Set description
     *
     * @param string $description
     * @return Route
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
     * Set slug
     *
     * @param string $slug
     * @return Route
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add route_points
     *
     * @param \Interactive\POIWebAppBundle\Entity\RoutePoint $routePoints
     * @return Route
     */
    public function addRoutePoint(\Interactive\POIWebAppBundle\Entity\RoutePoint $routePoints)
    {
        $this->route_points[] = $routePoints;

        return $this;
    }

    /**
     * Remove route_points
     *
     * @param \Interactive\POIWebAppBundle\Entity\RoutePoint $routePoints
     */
    public function removeRoutePoint(\Interactive\POIWebAppBundle\Entity\RoutePoint $routePoints)
    {
        $this->route_points->removeElement($routePoints);
    }

    /**
     * Get route_points
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoutePoints()
    {
        return $this->route_points;
    }
    /**
     * @ORM\PrePersist
     */
    public function setSlugValue()
    {
        // Add your code here
    }
}

<?php

namespace Interactive\POIWebAppBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;

/**
 * PointOfInteres
 */
class PointOfInterest
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $latitude;

    /**
     * @var string
     */
    public $longitude;

    /**
     * @var string
     */
    public $description;

    /**
     * @var boolean
     */
    public $is_activated;

    /**
     * @var \DateTime
     */
    public $created_at;

    /**
     * @var \DateTime
     */
    public $updated_at;

    /**
     * @var \Interactive\POIWebAppBundle\Entity\Category
     */
    public $category;


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
     * Set latitude
     *
     * @param string $latitude
     * @return PointOfInterest
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
     * @return PointOfInterest
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
     * @return PointOfInterest
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
     * Set is_activated
     *
     * @param boolean $isActivated
     * @return PointOfInterest
     */
    public function setIsActivated($isActivated)
    {
        $this->is_activated = $isActivated;

        return $this;
    }

    /**
     * Get is_activated
     *
     * @return boolean 
     */
    public function getIsActivated()
    {
        return $this->is_activated;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return PointOfInterest
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
     * @return PointOfInterest
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
     * Set category
     *
     * @param \Interactive\POIWebAppBundle\Entity\Category $category
     * @return PointOfInterest
     */
    public function setCategory(\Interactive\POIWebAppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Interactive\POIWebAppBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if(!$this->getCreatedAt()) {
            $this->created_at = new \DateTime();
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
       $this->updated_at = new \DateTime();
    }
    /**
     * @var string
     */
    public $address;


    /**
     * Set address
     *
     * @param string $address
     * @return PointOfInterest
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @ORM\PrePersist
     */
    public function setExpiresAtValue()
    {
        // Add your code here
    }
    /**
     * @var \Interactive\POIWebAppBundle\Entity\GeoCity
     */
    public $geocity;


    /**
     * Set geocity
     *
     * @param \Interactive\POIWebAppBundle\Entity\GeoCity $geocity
     * @return PointOfInterest
     */
    public function setGeocity(\Interactive\POIWebAppBundle\Entity\GeoCity $geocity = null)
    {
        $this->geocity = $geocity;

        return $this;
    }

    /**
     * Get geocity
     *
     * @return \Interactive\POIWebAppBundle\Entity\GeoCity 
     */
    public function getGeocity()
    {
        return $this->geocity;
    }
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $phone_ext;

    /**
     * @var string
     */
    public $fax;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $schedule;


    /**
     * Set name
     *
     * @param string $name
     * @return PointOfInterest
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
     * Set phone
     *
     * @param string $phone
     * @return PointOfInterest
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone_ext
     *
     * @param string $phoneExt
     * @return PointOfInterest
     */
    public function setPhoneExt($phoneExt)
    {
        $this->phone_ext = $phoneExt;

        return $this;
    }

    /**
     * Get phone_ext
     *
     * @return string 
     */
    public function getPhoneExt()
    {
        return $this->phone_ext;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return PointOfInterest
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return PointOfInterest
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set schedule
     *
     * @param string $schedule
     * @return PointOfInterest
     */
    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * Get schedule
     *
     * @return string 
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * @ORM\PrePersist
     */
    public function setIsActivatedVale()
    {
        $this->is_activated = true;
    }
    /**
     * @var \Interactive\POIWebAppBundle\Entity\Route
     */
    private $route;


    /**
     * Set route
     *
     * @param \Interactive\POIWebAppBundle\Entity\Route $route
     * @return PointOfInterest
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
     * @var \Interactive\POIWebAppBundle\Entity\RoutePoint
     */
    private $near_route_point;


    /**
     * Set near_route_point
     *
     * @param \Interactive\POIWebAppBundle\Entity\RoutePoint $nearRoutePoint
     * @return PointOfInterest
     */
    public function setNearRoutePoint(\Interactive\POIWebAppBundle\Entity\RoutePoint $nearRoutePoint = null)
    {
        $this->near_route_point = $nearRoutePoint;

        return $this;
    }

    /**
     * Get near_route_point
     *
     * @return \Interactive\POIWebAppBundle\Entity\RoutePoint 
     */
    public function getNearRoutePoint()
    {
        return $this->near_route_point;
    }
    
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $img;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setImg(UploadedFile $file = null)
    {
        $this->img = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getImg()
    {
        return $this->img;
    }
    
}

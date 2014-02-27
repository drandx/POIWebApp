<?php

namespace Interactive\POIWebAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Interactive\POIWebAppBundle\Utils\POIWebApp;

/**
 * Category
 */
class Category
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $jobs;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $affiliates;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->jobs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->affiliates = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Category
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
     * Add jobs
     *
     * @param \Interactive\POIWebAppBundle\Entity\Job $jobs
     * @return Category
     */
    public function addJob(\Interactive\POIWebAppBundle\Entity\Job $jobs)
    {
        $this->jobs[] = $jobs;

        return $this;
    }

    /**
     * Remove jobs
     *
     * @param \Interactive\POIWebAppBundle\Entity\Job $jobs
     */
    public function removeJob(\Interactive\POIWebAppBundle\Entity\Job $jobs)
    {
        $this->jobs->removeElement($jobs);
    }

    /**
     * Get jobs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * Add affiliates
     *
     * @param \Interactive\POIWebAppBundle\Entity\Affiliate $affiliates
     * @return Category
     */
    public function addAffiliate(\Interactive\POIWebAppBundle\Entity\Affiliate $affiliates)
    {
        $this->affiliates[] = $affiliates;

        return $this;
    }

    /**
     * Remove affiliates
     *
     * @param \Interactive\POIWebAppBundle\Entity\Affiliate $affiliates
     */
    public function removeAffiliate(\Interactive\POIWebAppBundle\Entity\Affiliate $affiliates)
    {
        $this->affiliates->removeElement($affiliates);
    }

    /**
     * Get affiliates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAffiliates()
    {
        return $this->affiliates;
    }
    
    public function __toString()
    {
        return $this->getName() ? $this->getName() : "";
    }
    
    
    public function getSlug()
    {
        return POIWebApp::slugify($this->getName());
    }
    
}

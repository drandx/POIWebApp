<?php
namespace Interactive\POIWebAppBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
 
/**
 * User
 */
class User implements UserInterface
{
    /**
     * @var integer
     */
    private $id;
 
    /**
     * @var string
     */
    private $username;
 
    /**
     * @var string
     */
    private $password;
 
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
 
    }
 
    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }
 
    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
 
    }
 
    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }
 
    public function getSalt()
    {
        return null;
    }
 
    public function eraseCredentials()
    {
 
    }
 
    public function equals(User $user)
    {
        return $user->getEmail() == $this->getEmail();
    }        
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;


    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $roles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add roles
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $roles
     * @return User
     */
    public function addRole($roles)
    {
       if(is_array($roles))
       {
           $this->roles = $roles;
       }
       else
       { 
           $roleArray = array();
           array_push($roleArray, $roles);
           $this->roles = $roleArray;
       }

        return $this;
    }

    /**
     * Remove roles
     *
     * 
     */
    public function removeRole($roles)
    {
        $this->roles->removeElement($roles);
    }
    
    public function getRoles()
    {
        $roleStrings = array('');
        foreach ($this->roles as $obj) {
            $string = $obj->getRole();
            array_push($roleStrings, $string."");
        }
        return $roleStrings;
    }
    
    public function getRolesArray()
    {
        return $this->roles;
    }
    
}

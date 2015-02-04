<?php
// src/Acme/UserBundle/Entity/User.php

namespace Project\VideoBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @ORM\Column(type="string", length=255)
    */
    protected $firstname;

    /**
    * @ORM\Column(type="string", length=255)
    */
    protected $lastname;

    /**
    * Set firstname
    *
    * @param string $firstname
    * @return User
    */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
    * Get firstname
    *
    * @return string
    */
    public function getFirstname()
    {
        return $this->firstname;
    }

        /**
    * Set lastname
    *
    * @param string $lastname
    * @return User
    */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
    * Get lastname
    *
    * @return string
    */
    public function getLasttname()
    {
        return $this->lastname;
    }

    public function __construct()
    {
        parent::__construct();
        // your own logic
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
}

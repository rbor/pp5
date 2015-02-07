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
    public function getLastname()
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

    /**
    * @ORM\OneToMany(targetEntity="Project\VideoBundle\Entity\Comment", mappedBy="user_id")
    */
    protected $comments;

    /**
     * Add comments
     *
     * @param \Project\VideoBundle\Entity\Comment $comments
     * @return User
     */
    public function addComment(\Project\VideoBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Project\VideoBundle\Entity\Comment $comments
     */
    public function removeComment(\Project\VideoBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
    /**
    * @ORM\OneToMany(targetEntity="Project\VideoBundle\Entity\OrderCart", mappedBy="user_id")
    */
    protected $orders;

    /**
     * Add orders
     *
     * @param \Project\VideoBundle\Entity\OrderCart $orders
     * @return User
     */
    public function addOrder(\Project\VideoBundle\Entity\OrderCart $orders)
    {
        $this->orders[] = $orders;

        return $this;
    }

    /**
     * Remove orders
     *
     * @param \Project\VideoBundle\Entity\OrderCart $orders
     */
    public function removeOrder(\Project\VideoBundle\Entity\OrderCart $orders)
    {
        $this->orders->removeElement($orders);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrders()
    {
        return $this->orders;
    }
}

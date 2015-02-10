<?php

namespace Project\VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movie
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Movie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="imdb_id", type="string")
     */
    private $imdbId;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;


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
     * Set imdbId
     *
     * @param string $imdbId
     * @return Movie
     */
    public function setImdbId($imdbId)
    {
        $this->imdbId = $imdbId;

        return $this;
    }

    /**
     * Get imdbId
     *
     * @return string 
     */
    public function getImdbId()
    {
        return $this->imdbId;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Movie
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
    * @ORM\OneToMany(targetEntity="Project\VideoBundle\Entity\OrderCart", mappedBy="movie_id")
    */
    protected $orders;
    /**
    * @ORM\OneToMany(targetEntity="Project\VideoBundle\Entity\Comment", mappedBy="movie_id")
    */
    protected $comments;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orders = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add orders
     *
     * @param \Project\VideoBundle\Entity\OrderCart $orders
     * @return Movie
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

    /**
     * Add comments
     *
     * @param \Project\VideoBundle\Entity\Comment $comments
     * @return Movie
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
}

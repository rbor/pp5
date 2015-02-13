<?php

namespace Project\VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderCart
 *
 * @ORM\Table(name="orderCarts")
 * @ORM\Entity
 */
class OrderCart
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
     * @var integer
     *
     * @ORM\Column(name="movie_id", type="integer")
     */
    private $movieId;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expired_date", type="datetime")
     */
    private $expiredDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;


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
     * Set movieId
     *
     * @param integer $movieId
     * @return OrderCart
     */
    public function setMovieId($movieId)
    {
        $this->movieId = $movieId;

        return $this;
    }

    /**
     * Get movieId
     *
     * @return integer 
     */
    public function getMovieId()
    {
        return $this->movieId;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return OrderCart
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
     * Set status
     *
     * @param string $status
     * @return OrderCart
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set expiredDate
     *
     * @param \DateTime $expiredDate
     * @return OrderCart
     */
    public function setExpiredDate($expiredDate)
    {
        $this->expiredDate = $expiredDate;

        return $this;
    }

    /**
     * Get expiredDate
     *
     * @return \DateTime 
     */
    public function getExpiredDate()
    {
        return $this->expiredDate;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return OrderCart
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
    /**
    * @ORM\ManyToOne(targetEntity="Project\VideoBundle\Entity\User", inversedBy="orders")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
    */
    protected $user;
    /** 
    * @ORM\ManyToOne(targetEntity="Project\VideoBundle\Entity\Movie", inversedBy="movies")
    * @ORM\JoinColumn(name="movie_id", referencedColumnName="id", nullable=false)
    */
    protected $movie;


    /**
     * Set user
     *
     * @param \Project\VideoBundle\Entity\User $user
     * @return OrderCart
     */
    public function setUser(\Project\VideoBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Project\VideoBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set movie
     *
     * @param \Project\VideoBundle\Entity\Movie $movie
     * @return OrderCart
     */
    public function setMovie(\Project\VideoBundle\Entity\Movie $movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get movie
     *
     * @return \Project\VideoBundle\Entity\Movie 
     */
    public function getMovie()
    {
        return $this->movie;
    }
}

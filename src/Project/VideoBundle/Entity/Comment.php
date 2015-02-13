<?php

namespace Project\VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Comment
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
     * @ORM\Column(name="movie_id", type="string")
     */
    private $movieId;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

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
     * @param string $movieId
     * @return Comment
     */
    public function setMovieId($movieId)
    {
        $this->movieId = $movieId;

        return $this;
    }

    /**
     * Get movieId
     *
     * @return string 
     */
    public function getMovieId()
    {
        return $this->movieId;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Comment
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Comment
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
    * @ORM\ManyToOne(targetEntity="Project\VideoBundle\Entity\User", inversedBy="comments")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
    */
    protected $user;

    /**
     * Set user
     *
     * @param \Project\VideoBundle\Entity\User $user
     * @return Comment
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
    /** @ORM\ManyToOne(targetEntity="Project\VideoBundle\Entity\Movie", inversedBy="comments")
    * @ORM\JoinColumn(name="movie_id", referencedColumnName="id", nullable=false)
    */
    protected $movies;

    /**
     * Set movies
     *
     * @param \Project\VideoBundle\Entity\Movie $movies
     * @return Comment
     */
    public function setMovies(\Project\VideoBundle\Entity\Movie $movies)
    {
        $this->movies = $movies;

        return $this;
    }

    /**
     * Get movies
     *
     * @return \Project\VideoBundle\Entity\Movie 
     */
    public function getMovies()
    {
        return $this->movies;
    }
}

<?php

namespace Project\VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genres")
 * @ORM\Entity
 */
class Genre
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
     * @ORM\Column(name="genre", type="string", length=255)
     */
    private $genre;

    /**
     * @var integer
     *
     * @ORM\Column(name="movie_id", type="integer")
     */
    private $movieId;


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
     * Set genre
     *
     * @param string $genre
     * @return Genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set movieId
     *
     * @param integer $movieId
     * @return Genre
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
    /** @ORM\ManyToOne(targetEntity="Project\VideoBundle\Entity\Movie", inversedBy="genres")
    * @ORM\JoinColumn(name="movie_id", referencedColumnName="id", nullable=false)
    */
    protected $movie;

    /**
     * Set movie
     *
     * @param \Project\VideoBundle\Entity\Movie $movie
     * @return Genre
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

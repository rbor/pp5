<?php

namespace Project\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Project\VideoBundle\Entity\Movie;

class DefaultController extends Controller
{
    public function indexAction()
    {
		$movies = $this->getDoctrine()
        ->getRepository('ProjectVideoBundle:Movie')
        ->findAll();

        $genres = $this->getDoctrine()
        ->getRepository('ProjectVideoBundle:Genre')
        ->findAll();

        $movieGenres = array();

        foreach ($genres as $item) {
            $movieGenres[] = $item->getGenre();
        }
        // var_dump(array_unique($movieGenres));die();

        return $this->render('ProjectVideoBundle:Default:index.html.twig', array(
        	'movies' => $movies,
            'genres' => array_unique($movieGenres)
        	));
    }

    public function mainAction()
    {
        return $this->render('ProjectVideoBundle:Default:main.html.twig');
    }

    public function genreAction()
    {
        return $this->render('ProjectVideoBundle:Default:genre.html.twig');
    }
}

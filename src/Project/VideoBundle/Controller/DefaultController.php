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

        return $this->render('ProjectVideoBundle:Default:index.html.twig', array(
        	'movies' => $movies
        	));
    }
}

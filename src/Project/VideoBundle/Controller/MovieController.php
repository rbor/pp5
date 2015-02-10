<?php

namespace Project\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Project\VideoBundle\Entity\Movie;

class MovieController extends Controller
{
    public function movieAction($movie)
    {
        $movies = $this->getDoctrine()
        ->getRepository('ProjectVideoBundle:Movie')
        ->findByimdb_id($movie);

		$title = $movies[0]->getTitle();
        $plot = $movies[0]->getPlot();
        $actors = $movies[0]->getActors();
        $poster = $movies[0]->getPoster();

        return $this->render('ProjectVideoBundle:Movie:movie.html.twig', array(
        	'title' 	=> $title,
        	'plot' 		=> $plot,
        	'actors' 	=> $actors,
        	'poster' 	=> $poster
        	 ));
    }

    public function addMovieAction($movieId){

        $url = 'http://www.omdbapi.com/?i='.$movieId.'&y=&plot=full&r=json';
        $json = file_get_contents($url);
        $data = json_decode($json, TRUE);

        $title = $data['Title'];
        $plot = $data['Plot'];
        $actors = $data['Actors'];

        if($data['Poster'] != 'N/A')
            $poster = $data['Poster'];
        else
            $poster = 'N/A';

        $movie = new Movie();
        
        $movie->setImdbId($movieId);
        $movie->setPrice(20.00);
        $movie->setTitle($title);
        $movie->setPlot($plot);
        $movie->setActors($actors);
        $movie->setPoster($poster);

        $em = $this->getDoctrine()->getManager();
        $em->persist($movie);
        $em->flush();

        return $this->render('ProjectVideoBundle:Movie:done.html.twig');
    }

}

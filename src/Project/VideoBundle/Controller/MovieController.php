<?php

namespace Project\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MovieController extends Controller
{
    public function movieAction($movie)
    {
    	$url = 'http://www.omdbapi.com/?t='.$movie.'&y=&plot=full&r=json';
    	$json = file_get_contents($url);
		$data = json_decode($json, TRUE);

		$title = $data['Title'];
		$description = $data['Plot'];
		$actors = $data['Actors'];
		$poster = $data['Poster'];

        return $this->render('ProjectVideoBundle:Movie:movie.html.twig', array(
        	'title' 	=> $title,
        	'desc' 		=> $description,
        	'actors' 	=> $actors,
        	'poster' 	=> $poster
        	 ));
    }
}

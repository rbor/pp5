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
        
        if($data['Poster'] != 'N/A')
            $poster = $data['Poster'];
        else
            $poster = null;

        return $this->render('ProjectVideoBundle:Movie:movie.html.twig', array(
        	'title' 	=> $title,
        	'desc' 		=> $description,
        	'actors' 	=> $actors,
        	'poster' 	=> $poster
        	 ));
    }

    public function idAction($movie)
    {
        $url = 'http://www.omdbapi.com/?i='.$movie.'&y=&plot=full&r=json';
        $json = file_get_contents($url);
        $data = json_decode($json, TRUE);

        $title = $data['Title'];
        $description = $data['Plot'];
        $actors = $data['Actors'];

        if($data['Poster'] != 'N/A')
            $poster = $data['Poster'];
        else
            $poster = null;

        return $this->render('ProjectVideoBundle:Movie:movie.html.twig', array(
            'title'     => $title,
            'desc'      => $description,
            'actors'    => $actors,
            'poster'    => $poster
             ));
    }

    public function searchAction($movie)
    {
        $url = 'http://www.omdbapi.com/?s='.$movie.'&y=&type=movie&r=json';
        $json = file_get_contents($url);
        $data = json_decode($json, TRUE);

        $list = $data['Search'];

        return $this->render('ProjectVideoBundle:Movie:search.html.twig', array('list' => $list));
    }


    public function findAction()
    {
        return $this->render('ProjectVideoBundle:Movie:find.html.twig');
    }

}

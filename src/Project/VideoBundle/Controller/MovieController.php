<?php

namespace Project\VideoBundle\Controller;

use Project\VideoBundle\Entity\Movie;
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

    public function createDatabaseStuffAction(){
        $movies = array(
            'titanic'       => 'tt0120338',
            'braveheart'    => 'tt0112573',
            'matrix'        => 'tt0106062',
            'django'        => 'tt0060315',
            'goodfellas'    => 'tt0099685',
            'inception'     => 'tt1375666',
            'bogowie'       => 'tt3745620',
            'gladiator'     => 'tt0172495',
            'casino'        => 'tt0112641',
            'alien'         => 'tt0078748'
        );

        $em = $this->getDoctrine()->getManager();

        foreach ($movies as $key => $value) {
            $movie = new Movie();
            $movie->setImdbId($value);
            $movie->setPrice(20.0);
            $em->persist($movie);
            $em->flush();
        }

        return $this->render('ProjectVideoBundle:Movie:done.html.twig');
    }

}

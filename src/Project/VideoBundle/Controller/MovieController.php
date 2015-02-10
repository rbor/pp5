<?php

namespace Project\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Project\VideoBundle\Entity\Movie;
use Project\VideoBundle\Entity\Comment;

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
        $price = $movies[0]->getPrice();

        $comments = $this->getDoctrine()
        ->getRepository('ProjectVideoBundle:Comment')
        ->findBymovie_id($movies[0]->getId());

        return $this->render('ProjectVideoBundle:Movie:movie.html.twig', array(
        	'title' 	=> $title,
        	'plot' 		=> $plot,
        	'actors' 	=> $actors,
            'poster'    => $poster,
        	'price' 	=> $price,
            'comments'  => $comments
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

    public function addCommentAction(){
        $comment = new Comment();

        $comment->setMovieId(3);
        // var_dump($comment->getMovieId());die();
        $comment->setValue('Ja też czekam na druga czesc.');
        $comment->setUserId(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        return $this->render('ProjectVideoBundle:Movie:done.html.twig');
    }

}

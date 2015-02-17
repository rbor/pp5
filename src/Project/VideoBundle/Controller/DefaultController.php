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

         $repository = $this->getDoctrine()
        ->getRepository('ProjectVideoBundle:Comment')
        ->findAll();

        // Movies by reviews
        $comments = array();

        foreach ($repository as $key => $value) {
            $comments[] = $value->getMovieId();
        }

        $comments = array_count_values($comments);
        arsort($comments);
        $popularByComments = array();

        foreach ($comments as $key => $value) {
            if(array_key_exists($value, $movies)){
                $popularByComments[] = $key;
            }
        }

        // Ids of 4 most commented movies
        $mostCommentedQuatro = array();

        if(count($popularByComments) > 4){
            for($i = 0; $i<4; $i++){
                $mostCommentedTrio[] = $popularByComments[$i];       
            }
        } else {
            $mostCommentedQuatro = $popularByComments;
        }

        // Data of 4 most commented movies
        $mostCommentedMovies = array();

        foreach ($movies as $key => $value) {
            if(in_array($value->getId(), $mostCommentedTrio)){
                $mostCommentedMovies[array_search($value->getId(), $mostCommentedTrio)] = $value;
            }
        }

        return $this->render('ProjectVideoBundle:Default:index.html.twig', array(
        	'movies'    => $movies,
            'genres'    => array_unique($movieGenres),
            'commented' => $mostCommentedMovies
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

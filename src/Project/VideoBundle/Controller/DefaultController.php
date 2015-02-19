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

        // MOST COMMENTED MOVIES
        // Movies by comments
        $comments = array();

        foreach ($repository as $key => $value) {
            $comments[] = $value->getMovieId();
        }

        $comments = array_count_values($comments);
        arsort($comments);

        // Ids of commented movies
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
                $mostCommentedQuatro[] = $popularByComments[$i];       
            }
        } else {
            $mostCommentedQuatro = $popularByComments;
        }

        // Data of 4 most commented movies
        $mostCommentedMovies = array();

        foreach ($movies as $key => $value) {
            if(in_array($value->getId(), $mostCommentedQuatro)){
                $mostCommentedMovies[array_search($value->getId(), $mostCommentedQuatro)] = $value;
            }
        }

        // MOST ORDERED MOVIES

        $orders = $this->getDoctrine()
        ->getRepository('ProjectVideoBundle:OrderCart')
        ->findAll();

        // Movies by ordered
        $ordered = array();

        foreach ($orders as $key => $value) {
            $ordered[] = $value->getMovieId();
        }

        $ordered = array_count_values($ordered);
        arsort($ordered);

        // Ids of ordered movies
        $popularByOrders = array();

        foreach ($ordered as $key => $value) {
            if(array_key_exists($value, $movies)){
                $popularByOrders[] = $key;
            }
        }

        // Ids of 4 most ordered movies
        $mostOrderedQuatro = array();

        if(count($popularByOrders) > 4){
            for($i = 0; $i<4; $i++){
                $mostOrderedQuatro[] = $popularByOrders[$i];       
            }
        } else {
            $mostOrderedQuatro = $popularByOrders;
        }

        // Data of 4 most ordered movies
        $mostOrdereddMovies = array();

        foreach ($movies as $key => $value) {
            if(in_array($value->getId(), $mostOrderedQuatro)){
                $mostOrdereddMovies[array_search($value->getId(), $mostOrderedQuatro)] = $value;
            }
        }

        // var_dump($mostOrdereddMovies);die();

        return $this->render('ProjectVideoBundle:Default:index.html.twig', array(
        	'movies'    => $movies,
            'genres'    => array_unique($movieGenres),
            'commented' => $mostCommentedMovies,
            'ordered'   => $mostOrdereddMovies
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

    public function myOrdersAction(){
        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $em = $this->getDoctrine()->getManager();
        $myOrders = $em->getRepository('ProjectVideoBundle:OrderCart')->findByuser_id($userId);

        $moviesId = array();

        foreach ($myOrders as $key => $value) {
            $moviesId[] = $value->getMovieId();
        }

        $repo = $this->getDoctrine()->getRepository('ProjectVideoBundle:Movie');
        $movies = $repo->findBy(array('id' => $moviesId));
        // var_dump($movies);die();

        return $this->render('ProjectVideoBundle:Default:my.html.twig', array(
            'orders'    => $movies
            ));

    }
}

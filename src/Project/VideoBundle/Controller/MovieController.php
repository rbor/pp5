<?php

namespace Project\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Project\VideoBundle\Entity\Movie;
use Project\VideoBundle\Entity\Genre;
use Project\VideoBundle\Entity\Comment;
use Project\VideoBundle\Form\CommentType;

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

        $user = $this->get('security.context')->getToken()->getUser();

        if($user == 'anon.'){
            return $this->render('ProjectVideoBundle:Movie:movie.html.twig', array(
            'title'     => $title,
            'plot'      => $plot,
            'actors'    => $actors,
            'poster'    => $poster,
            'price'     => $price,
            'comments'  => $comments,
            'movie_id'  => null,
            'user_id'   => null
             ));
        }
            // var_dump($title);

        $userId = $user->getId();

        return $this->render('ProjectVideoBundle:Movie:movie.html.twig', array(
        	'title' 	=> $title,
        	'plot' 		=> $plot,
        	'actors' 	=> $actors,
            'poster'    => $poster,
        	'price' 	=> $price,
            'comments'  => $comments,
            'movie_id'  => $movie,
            'user_id'   => $userId
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
        $comment->setValue('Ja też czekam na druga czesc.');
        $comment->setUserId(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        return $this->render('ProjectVideoBundle:Movie:done.html.twig');
    }

    public function commentAction(Request $request, $userId, $movieId){
        
        $comment = new Comment();
        $movie = new Movie();

        $form = $this->createForm(
            new CommentType(),
            $comment
        );

        if ($request->isMethod('POST') && $form->handleRequest($request)){
            if ($form->isValid()) {
                $comment->setUserId($userId);
                $comment->setMovieId($movieId);

                $user = $this->getUser();
                $comment->setUser($user);

                $x = $this->getDoctrine()
                ->getRepository('ProjectVideoBundle:Movie')
                ->findByimdb_id($movieId);
                $movie = $x[0];

                $comment->setMovies($movie);
                $em = $this->getDoctrine()->getManager();
                $em->persist($comment);
                $em->flush();
                
                return new RedirectResponse($this->generateUrl('project_movie_movie', array('movie' => $movieId)));

                }
            }

        return $this->render('ProjectVideoBundle:Movie:comment.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function addGenreAction($movieId){
        $url = 'http://www.omdbapi.com/?i='.$movieId.'&y=&plot=full&r=json';
        $json = file_get_contents($url);
        $data = json_decode($json, TRUE);

        $genres = explode(', ', $data['Genre']);

        // var_dump($genres);die();

        $x = $this->getDoctrine()
            ->getRepository('ProjectVideoBundle:Movie')
            ->findByimdb_id($movieId);
        $movie = $x[0];

        // var_dump($x);die();

        foreach ($genres as $item) {
            // var_dump($item);die();
            $movieGenre = new Genre();
        
            $movieGenre->setMovie($movie);
            $movieGenre->setGenre($item);

            $em = $this->getDoctrine()->getManager();
            $em->persist($movieGenre);
            $em->flush();
        }

        // return $this->render('ProjectVideoBundle:Movie:done.html.twig');
        return true;
    }

    public function genreAction($genre){

        $x = $this->getDoctrine()
            ->getRepository('ProjectVideoBundle:Genre')
            ->findBygenre($genre);

        // var_dump($x[0]->getMovieId());die();

        $moviesId = array();

        foreach ($x as $item) {
            $moviesId[] = $item->getMovieId();
        }
        
        // var_dump($moviesId);die();

        $movies = array();
        $imbdIds = array();

        foreach ($moviesId as $item) {
            $x = $this->getDoctrine()
            ->getRepository('ProjectVideoBundle:Movie')
            ->findByid($item);

            $movies[] =  array($x[0]->getImdbId(), $x[0]->getPoster());
        }
        
        // var_dump($movies);die();
        return $this->render('ProjectVideoBundle:Movie:genre.html.twig', array(
            'movies'    => $movies,
            ));

    }

}

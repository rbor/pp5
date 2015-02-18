<?php

namespace Project\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Project\VideoBundle\Entity\Movie;

class CartController extends Controller
{
	public function addItemAction($item){

	$isAlreadyInCart = false;

	$session = $this->getRequest()->getSession();
        $cart = $session->get('cart');

        $movies = $this->getDoctrine()
        ->getRepository('ProjectVideoBundle:Movie')
        ->findByimdb_id($item);

        $title = $movies[0]->getTitle();
        $price = $movies[0]->getPrice();

        $newItem = array(
        	'imdb' 	=> $item,
        	'title'	=> $title,
        	'price'	=> $price
        	);

        foreach ($cart as $key => $value) {
        	if ($value['imdb'] == $item){
	        	$isAlreadyInCart = true;
        	}
        }

        if($isAlreadyInCart == false){
	        $cart[] = $newItem;
			$session->set('cart', $cart);
        }

        return new RedirectResponse($this->generateUrl('project_movie_movie', array(
        	'movie' => $item)));
	}

	public function removeItemAction($item){
		$session = $this->getRequest()->getSession();
        $cart = $session->get('cart');
        $keyToDelete;

        foreach ($cart as $key => $value) {
        	if($value['imdb'] == $item){
		     	$keyToDelete = $key;
        	}
        }

        unset($cart[$keyToDelete]);
        $session->set('cart', $cart);
        

        return new RedirectResponse($this->generateUrl('project_movie_cart', array(
        	'cart' => $cart
        	)));
	}

	public function cartAction(){
	$session = $this->getRequest()->getSession();
        $cart = $session->get('cart');

        return $this->render('ProjectVideoBundle:Cart:cart.html.twig', array(
        	'cart' => $cart
        	));
	}
}
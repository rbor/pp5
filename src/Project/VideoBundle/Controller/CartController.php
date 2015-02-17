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

        foreach ($cart as $key => $value) {
        	if ($value == $item){
	        	$isAlreadyInCart = true;
        	}
        }

        if($isAlreadyInCart == false){
	        $cart[] = $item;
			$session->set('cart', $cart);
        }
        // var_dump($cart);die();

        return new RedirectResponse($this->generateUrl('project_movie_movie', array('movie' => $item)));
	}
}
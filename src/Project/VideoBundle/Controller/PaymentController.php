<?php

namespace Project\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Project\VideoBundle\Entity\OrderCart;

class PaymentController extends Controller
{
    public function payAction($total)
    {
    	$user = $this->get('security.context')->getToken()->getUser();
    	$firstname = $user->getFirstname();
    	$lastname = $user->getLastname();
    	$email = $user->getEmail();
    	$control=$user->getUsername();
    	$date=date('dmYHis');
    	$orderNumber=$control.'_'.$date;
    	$datetime = date_create();
        $userId = $user->getId();

        $session = $this->getRequest()->getSession();
        $cart = $session->get('cart');
        $moviesId = array();

        foreach ($cart as $key => $value) {
        	$moviesId[] = $value['imdb'];
        }

        $repo = $this->getDoctrine()->getRepository('ProjectVideoBundle:Movie');
        $movies = $repo->findBy(array('imdbId' => $moviesId));

        $em = $this->getDoctrine()->getManager();

        for ($i=0; $i < count($movies); $i++) {

        	$orderCart = new OrderCart();

	        $orderCart->setOrderNumber($orderNumber);
	        $orderCart->setStatus("Order");
	        $orderCart->setPrice($total);
	        $orderCart->setExpiredDate($datetime);
	        $orderCart->setOrderDate($datetime);
	        $orderCart->setUser($user);
        	$orderCart->setMovie($movies[$i]);
        	
	        $em->persist($orderCart);
	        $em->flush();
        }

        $data=array(
			'id' => 72890,
			'amount' => $total,
			'currency' => 'PLN',
			'description' => $orderNumber,
			'control' => $control,
			'firstname' => $firstname,
			'lastname' => $lastname,
			'email' => $email,
			'URLC' => 'http://v-ie.uek.krakow.pl/~s177141/app.php/payment/handle'
		);
		
		$params = http_build_query($data);
		
		$url = sprintf(
			'%s?%s',
			'https://ssl.dotpay.pl/',
			$params
		);

		$session = $this->getRequest()->getSession();
		$session->remove('cart');
		
		return new RedirectResponse ($url);
    }
	
	public function handleAction(Request $request)
	{
		$logger = $this->get('monolog.logger.dotpay');
		$logger->info('===== NEW URLC NOTIFICATION =======');
		$logger->info(var_export($request->request, true));
		//postman rest client
		$response = $this->get('payment.handler')
		->handleRequest($request);

		return new Response($response);
	}
}
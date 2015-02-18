<?php

namespace Project\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function payAction($total)
    {
    	$user = $this->get('security.context')->getToken()->
    	getUser();
    	$firstname = $user->getFirstname();
    	$lastname = $user->getLastname();
    	$email = $user->getEmail();
    	$control=$user->getUsername();
    	$date=date('dmYHis');
    	$orderNumber=$control.'_'.$date;
        $data=array(
			'id' => 72890,
			'amount' => $total,
			'currency' => 'PLN',
			'description' => $orderNumber,
			'control' => $control,
			'firstname' => $firstname,
			'lastname' => $lastname,
			'email' => $email,
			'URLC' => 'http://localhost/pp5/web/app_dev.php/payment/handle'
		);
		
		$params = http_build_query($data);
		
		$url = sprintf(
			'%s?%s',
			'https://ssl.dotpay.pl/',
			$params
		);
		
		return new RedirectResponse ($url);
    }
	
	public function handleAction(Request $request)
	{
		$logger = $this->get('monolog.logger.dotpay');
		$logger->info('===== NEW URLC NOTIFICATION =======');
		$logger->info(var_export($request->request, true));
		//postman rest client
		$response = $this->get('payment.handler')
		->handleRequest($request)
		;
		return new Response($response);
	}
}
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
    	var_dump($total);die();

        $data=array(
			'id' => 72890,
			'amount' => 222.52,
			'currency' => 'PLN',
			'description' => 'Zaplata',
			'control' => 'FV-153255',
			'firstname' => 'Imie',
			'lastname' => 'Nazwisko',
			'email' => 'borusiewicz.radek@gmail.com',
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
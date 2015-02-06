<?php

namespace Project\VideoBundle\Payment;

class PaymentHandler
{
	const STATUS_DONE = 2;
	const TRANSACTION_OK = 'OK';
	const TRANSACTION_ERROR = 'ERROR';
	
	protected $clientId;
	protected $pin;
	protected $orderRepository;
	
	public function __construct($clientId, $pin,$orderRepository = null)
	{
		$this->clientId=$clientId;
		$this->pin->$pin;
		$this->orderRepository->$orderRepository;
	}
	
	public function handleRequest($request)
	{
		$hash = $this->calculateHash($request);
		
		if ($this->isTransactionValid(
		$hash,
		$request->request->get('md5'),
		$request->request->get('t_status'),
		$request->request->get('control')
		)) {
		//logika po transakcji
		
		return self::TRANSACTION_OK;
		} else {
		return self::TRANSACTION_ERROR;
		}
	}
	
	private function calculateHash($request)
	{
		$hash = sprintf(
		'%s:%s:%s:%s:%s:%s:%s:%s:%s:%s:%s',	
			$this->pin,
			$this->clientId,
			$request->request->get('control'),
			$request->request->get('t_id'),
			$request->request->get('amount'),
			$request->request->get('email'),
			$request->request->get('service'),
			$request->request->get('code'),
			$request->request->get('username'),
			$request->request->get('password'),
			$request->request->get('t_status'),
			
		
		);
		return md5($hash);
	}
	
	private function isTransactionValid(
		$hash, 
		$md5, 
		$status, 
		$orderNumber
	) {
		if ($hash != $md5) {
			return false;
		}
		if ($status != self::STATUS_DONE) {
			return false;
		}
		if (!$this->orderRepository->findOneBy(array('number' => $orderNumber))) {
			return false;
		}
			return true;
	}
}
<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller
{

	public function before()
	{
		parent::before();
		Request::current()->headers = array('Cache-Control' => 'no-store', 'Pragma' => 'no-cache');
		/* 	if(!$this->request->is_ajax())			
		  throw HTTP_Exception::factory(404, 'Такой записи нет'); */
	}

	public function action_addtocart()
	{
		$id = $this->request->post('id');
		$cart = Cookie::get('cart', array());
		if(!is_array($cart))
			$cart = unserialize($cart);
		if($id)
		{
			$cart[] = $id;
			if(Cookie::set('cart', serialize($cart)))
				echo 1;
			else
				echo 0;
		}
		else
			echo 0;
	}

	public function action_removefromcart()
	{
		$id = $this->request->param('id');
		echo $this->removefromcart($id);
	}

	public function action_quantity()
	{
		$id = $this->request->post('id');
		$method = $this->request->post('method');
		$sum = $this->request->post('sum');
		
		echo $this->quantity($id, (int) $method, $sum);
	}

	private function quantity($id, $method = 0, $sum = 0)
	{
		$cart = Cookie::get('cart', array());
		if(!is_array($cart))
			$cart = unserialize($cart);
		else
			return 0;
		if($id)
		{
			$price = (ORM::factory('Good', $id)->price)/100;
			if($method == 1)
			{
				$cart[] = $id;
				Cookie::set('cart', serialize($cart));
				return $sum + $price;
			}
			else
			{
				$newcart = array();
				foreach($cart as $row)
				{
					if($row != $id)
						$newcart[] = $row;
					else
						$id = null;
				}
				Cookie::set('cart', serialize($newcart));
				return $sum - $price;				
			}
		}
		return 0;
	}

	private function removefromcart($id)
	{
		$cart = Cookie::get('cart', array());
		if(!is_array($cart))
			$cart = unserialize($cart);
		else
			return 0;
		if(!is_null($id))
		{
			$cartarr = array();
			$cartser = array();
			$sum = 0;
			foreach($cart as $row)
			{
				if($row != $id)
				{
					$cartser[] = $row;
					if(!array_key_exists($row, $cartarr))
						$cartarr[$row] = 1;
					else
						$cartarr[$row]++;
				}
			}
			foreach($cartarr as $k => $v)
			{
				$item = ORM::factory('Good', $k);
				if($item->status == 1)
				{
					$sum += (($item->price) * $v) / 100;
				}
			}

			if(Cookie::set('cart', serialize($cartser)))
				return $sum;
			else
				return 0;
		}
		else
			return 0;
	}

}
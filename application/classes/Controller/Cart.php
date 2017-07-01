<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Cart extends Controller_Front
{

	public function action_index()
	{
		$cart = Cookie::get('cart', array());
		if(!is_array($cart))
			$cart = unserialize($cart);
		$cartarr = array();
		$this->template->title = 'Корзина | ';
		foreach($cart as $row)
		{
			if(!array_key_exists($row, $cartarr))
				$cartarr[$row] = 1;
			else
				$cartarr[$row]++;
		}
		$data = array(
				'cart' => $cartarr
		);
		$this->render($data);
	}

	public function action_order()
	{
		$this->template->scripts = array('http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js');
		$cart = Cookie::get('cart', array());
		$this->template->title = 'Оформление заказа | ';
		if(!is_array($cart))
			$cart = unserialize($cart);

		$cartarr = array();
		foreach($cart as $row)
		{
			if(!array_key_exists($row, $cartarr))
				$cartarr[$row] = 1;
			else
				$cartarr[$row]++;
		}

		$captcha = Captcha::instance();
		$captchaerror = '';
		$post = $this->request->post();
		if(!empty($post))
		{
			if(Captcha::valid($post['captcha']))
			{
				$model = ORM::factory('Order');
				$post['cart'] = serialize($cartarr);
				$post['ts'] = time();
				$model->values($post);
				$model->save();
				$reloaded = $model->reload();

				$orderlist = '';
				$sum = 0;
				foreach($cartarr as $k => $v)
				{
					$item = ORM::factory('Good', $k);
					if($item->status == 1)
					{
						$sum += (($item->price) / 100) * $v;
						$price = $item->price / 100;
						$orderlist .= '<li style="list-style:none"><a href="http://skazkabibabo.ru/shop/'.$item->id.'">'.$item->title.'</a> - '.$v.' шт. по '.$price.' руб.</li>';
					}
				}

				$emailadmin_body = '<p>Клиент '.$post['fio'].' с адреса '.$post['email'].' - сделал заказ под номером <b>'.$reloaded->id.'</b>:</p><ul>'.$orderlist.'</ul><p>Сумма заказа: '.$sum.' руб.</p><p>Телефон клиента: '.$post['phone'].'</p><p>Адрес доставки: '.$post['address'].'</p><p>Комментарий клиента: '.$post['comment'].'</p>';
				$emailadmin = Email::factory('Заказ №'.$reloaded->id, $emailadmin_body, 'text/html')
					->to('skazkabibabo@mail.ru')
					->from('noreply@skazkabibabo.ru', 'Интернет-магазин раннего развития')
					->send();

				$emailuser_body = '<p>Здравствуйте, '.$post['fio'].'</p><p>Ваш заказ номер <b>'.$reloaded->id.'</b> в <a href="http://skazkabibabo.ru">Магазине Сказка Бибабо</a> принят:</p><ul>'.$orderlist.'</ul><p>Сумма заказа: '.$sum.' руб.</p><p>В самое ближайшее время мы свяжемся с вами, чтобы доставить заказ.</p><p>До встречи!<br><a href="http://skazkabibabo.ru">Интернет-магазин раннего развития</a></p>';				
				$emailuser = Email::factory('Сказка Бибабо - Заказ №'.$reloaded->id, $emailuser_body, 'text/html')
					->to($post['email'])
					->from('noreply@skazkabibabo.ru', 'Интернет-магазин раннего развития')
					->send();
				Cookie::delete('cart');
				$this->redirect('/cart/ordersuccess');
			}
			else
			{
				$captchaerror = 'Неправильно введены буквы с картинки';
			}
		}
		$data = array(
				'cart' => $cartarr,
				'captcha' => $captcha->render(),
				'captchaerror' => $captchaerror
		);
		$this->render($data);
	}

	public function action_ordersuccess()
	{
		if(!strstr($this->request->referrer(), 'cart/order'))
			$this->redirect('/cart');
		$this->render();
	}

}


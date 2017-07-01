<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Widgets extends Controller_Blocks
{

	public function action_leftmenu()
	{
		$model = ORM::factory('Categories');
		$cat_list = $model->where('status', '=', '1')->order_by('sort', 'ASC')->find_all();
		$item_id = null;
		$request = Request::initial();
		$id = $request->param('item', false);
		if($id && $request->controller() == 'Shop')
			$item_id = ORM::factory('Good', $id)->cat_id;
		$data = array(
				'cat_list' => $cat_list,
				'item_id' => $item_id
		);
		$this->render($data);
	}

	public function action_rightmenu()
	{
		$this->render();
	}

	public function action_agemenu()
	{
		$model = ORM::factory('Age');
		$catmodel = ORM::factory('Categories');
		$controller = Request::initial()->controller();
		$action = Request::initial()->action();

		$age_list = $model->find_all();
		$cat_list = $catmodel->find_all();
		$arr = array();
		foreach($age_list as $row)
		{
			foreach($cat_list as $crow)
			{
				$carr[$crow->url] = $crow->title;
			}
			$arr[$row->url] = $carr;
		}
		$data = array(
				'action' => $action,
				'age_list' => $arr
		);
		$this->render($data);
	}

	public function action_news()
	{
		$model = ORM::factory('News');
		$data = array(
				'news_list' => $model->where('status', '=', '1')->order_by('date', 'DESC')->limit(3)->find_all()
		);
		$this->render($data);
	}

	public function action_video()
	{
		$model = ORM::factory('Video');
		$data = array(
				'video_list' => $model->where('status', '=', '1')->order_by('sort', 'ASC')->limit(4)->find_all()
		);
		$this->render($data);
	}

	public function action_cart()
	{
		$cart = Cookie::get('cart', array());
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
		$sum = 0;
		foreach($cartarr as $k => $v)
		{
			$item = ORM::factory('Good', $k);
			if($item->status == 1)
			{
				$sum += (($item->price) * $v) / 100;
			}
		}

		$data = array(
				'sum' => $sum,
				'empty' => empty($cart)
		);
		$this->render($data);
	}
	
	public function action_indextext()
	{
		$text = ORM::factory('Pages', array('url' => 'index'))->body;
		$data = array('text' => $text);
		$this->render($data);
	}
	
	public function action_phone()
	{
		$text = ORM::factory('Pages', array('url' => 'phone'))->body;
		$data = array('text' => $text);
		$this->render($data);
	}

}


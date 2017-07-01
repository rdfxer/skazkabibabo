<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_News extends Controller_Front
{

	public function action_index()
	{
		$model = ORM::factory('News')->where('status', '=', '1')->order_by('date', 'DESC')->find_all();
		$this->template->title = 'Новости | ';
		$data = array(
				'news' => $model
		);
		$this->render($data);
	}

}


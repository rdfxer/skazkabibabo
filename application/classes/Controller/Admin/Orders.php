<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Orders extends Controller_Admin
{

	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
		$model = ORM::factory('Order');
		$data = array(
				'list' => $model->find_all()
		);
		$this->render($data);
	}

	

}
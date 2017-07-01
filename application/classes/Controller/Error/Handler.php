<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Error_Handler extends Controller_Front
{

	public $template = 'layout/front';

	public function before()
	{
		parent::before();

	//	$this->template->content = URL::site(rawurldecode(Request::$initial->uri()));
		if(Request::$initial !== Request::$current)
		{
			if($message = rawurldecode($this->request->param('message')))
				$this->template->message = $message;
		}
		else
			$this->request->action(404);

		$this->response->status((int) $this->request->action());
	}

	public function action_404()
	{
	//	$this->template->title = '404 Страница не найдена';
	//	$this->template->cart = Request::factory('/widgets/cart')->execute();
		
	var_dump('123');
		if(isset($_SERVER['HTTP_REFERER']) AND strstr($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME']) !== FALSE)
			$this->template->local = TRUE;
		$this->response->status(404);
	}

	public function action_503()
	{
		$this->template->title = 'Сервис недоступен';
	}

	public function action_500()
	{
		$this->template->title = 'Внутренняя ошибка сервера';
	}

}
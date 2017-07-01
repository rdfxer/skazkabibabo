<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Blocks extends Layout
{
	public $template = 'layout/block';

	public function before()
	{
		parent::before();
		Request::current()->headers = array('Cache-Control' => 'no-store', 'Pragma' => 'no-cache');

		if($this->auto_render)
		{
			$this->template->content = '';
		}
		
		if(Request::initial()->directory() == 'Admin' && !Auth::instance()->logged_in('admin'))
			Controller::redirect('/');
	}

	/**
	 * Автоматически рендерит контроллер во вьюху вида "dir/controller/action".
	 *
	 * @chainable
	 * @param   array   $data     Массив для передачи данных во вьюху
	 * @return  Контейнер "content"
	 */
	public function render($data = array())
	{
		$controller = $this->request->controller();
		$action = $this->request->action();
		$dir = $this->request->directory();
		$file = strtolower($controller).'_'.$action;
		$this->template->content = View::factory($file, $data);
		return $this->template->content;
	}

	public function after()
	{
		parent::after();
	}

}
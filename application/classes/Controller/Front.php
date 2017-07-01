<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Front extends Layout
{

	public
		$template = 'layout/front';

	public function before()
	{
		parent::before();
		if($this->auto_render)
		{
			$this->template->action = '';
			$this->template->styles = array();
			$this->template->scripts = array();
			$this->template->title = '';
			$this->template->description = '';
			$this->template->keywords = '';
			$this->template->content = '';
			$this->template->leftmenu = '';
			$this->template->rightmenu = '';
			$this->template->cart = '';
			$this->template->agemenu = '';
			$this->template->pagination = '';
			$this->template->footer = '';
		}
	}

	/**
	 * Автоматически рендерит контроллер во вьюху вида "dir/controller_action".
	 *
	 * @chainable
	 * @param   array   $data     Массив для передачи данных во вьюху
	 */
	public function render($data = array(), $view = false)
	{
		$controller = $this->request->controller();
		$action = $this->request->action();
		if(!$view)
			$file = strtolower($controller).'_'.$action;
		else
			$file = $view;
		$this->template->content = View::factory($file, $data);
	}

	protected function action_view()
	{
		$model = ORM::factory($this->_model, $this->_id);
		if($model->loaded())
		{
			$data = array('item' => $model);
			$this->render($data);
		}
		else
			throw HTTP_Exception::factory(404, 'Такой записи нет');
	}

	protected function main_img($id)
	{
		$model = ORM::factory('Good', $id);
		$dirname = DOCROOT.'static/upload/goods/'.$id.'/';
		/* 	if(!empty($model->img_main))
		  $img = '/static/upload/goods/'.$id.'/'.$model->img_main;
		  else
		  { */
		if(!file_exists($dirname))
		{
			mkdir($dirname);
			mkdir($dirname.'s');
		}
		$imgdir = scandir($dirname);
		foreach($imgdir as $imgrow)
		{
			if(strlen($imgrow) > 3)
			{
				$imgfile = $imgrow;
				break;
			}
			else
				$imgfile = false;
		}
		if($imgfile)
			$img = '/static/upload/goods/'.$id.'/'.$imgfile;
		else
			$img = '/static/img/noimg.png';
		//	}
		return $img;
	}

	public function in_cart($id)
	{
		$cart = Cookie::get('cart', false);
		if($cart)
		{
			$cart = unserialize($cart);
			return in_array($id, $cart);
		}
		else
			return false;
	}

	public function after()
	{
		if($this->auto_render)
		{
			$styles = array(
					'static/style.css' => 'screen',
					'static/bootstrap.css' => 'screen',
			);
			$scripts = array(
					'https://yastatic.net/bootstrap/2.3.2/js/bootstrap.min.js',
					'https://yastatic.net/jquery/1.11.1/jquery.min.js',
			);

			$this->template->action = strtolower(Request::initial()->controller().'/'.Request::initial()->action());

			$this->template->styles = array_reverse(array_merge($this->template->styles, $styles));
			$this->template->scripts = array_reverse(array_merge($this->template->scripts, $scripts));
			$this->template->leftmenu = Request::factory('/widgets/leftmenu')->execute();
			$this->template->agemenu = Request::factory('/widgets/agemenu')->execute();
			$this->template->rightmenu = Request::factory('/widgets/rightmenu')->execute();
			$this->template->cart = Request::factory('/widgets/cart')->execute();
			//	$this->template->footer = Request::factory('block/index/footer')->execute();
		}
		//	echo View::factory('profiler/stats');
		parent::after();
	}

}
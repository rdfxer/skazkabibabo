<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Pages extends Controller_Front
{

	public function action_index()
	{
		$url = $this->request->param('url');
		if($url == 'oplata')
		{
			$this->template->styles = array('/static/js/showcase/css/style.css' => 'screen', '/static/js/highslide/highslide.css' => 'screen');
			$this->template->scripts = array('/static/js/showcase/showcase.js', '/static/js/highslide/highslide.js');
		}
		$model = ORM::factory('Pages', array('url' => $url));
		$this->template->title = (!empty($model->seo_title)) ? $model->seo_title.' | ' : $model->title.' | ';
		$this->template->description = $model->seo_descr;
		$this->template->keywords = $model->seo_keywords;
		if(!$model->loaded())
			throw HTTP_Exception::factory(404, 'Такой страницы нет!');
		
		$data = array(
				'page' => $model
		);
		$this->render($data);
	}

}


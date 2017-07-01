<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Video extends Controller_Front
{

	public function action_index()
	{
		$model = ORM::factory('Video')->where('status', '=', '1')->find_all();
		$this->template->title = 'Видео |';
		$data = array(
				'list' => $model
		);
		$this->render($data);
	}

	public function action_item()
	{
		$id = $this->request->param('id');
		$model = ORM::factory('Video', $id);
		$this->template->title = (!empty($model->seo_title)) ? $model->seo_title.' | ' : $model->title.' | ';
		$this->template->description = $model->seo_descr;
		$this->template->keywords = $model->seo_keywords;
		if(!$model->loaded() || $model->status == '0')
			throw HTTP_Exception::factory(404, 'Такой страницы нет!');
		$data = array(
				'item' => $model
		);
		$this->render($data);
	}

}


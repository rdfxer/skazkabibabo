<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Categories extends Controller_Admin
{

	public function before()
	{
		parent::before();
		$this->template->sidebar = Request::factory('/admin/sidebar/categories')->execute();
		$this->template->scripts = array('https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.7.1/ckeditor.js');
	}

	public function action_index()
	{
		$this->render();
	}

	public function action_edit()
	{
		$id = $this->request->param('id');
		$model = ORM::factory('Categories', $id);
		$videos = ORM::factory('Video')->where('status', '=', '1')->find_all();
		if(!$model->loaded())
			$this->redirect('/admin/categories');

		$post = $this->request->post();
		if(!empty($post))
		{
			$model->title = htmlspecialchars($post['title']);
			$model->seo_title = htmlspecialchars($post['seo_title']);
			$model->seo_keywords = htmlspecialchars($post['seo_keywords']);
			$model->seo_descr = htmlspecialchars($post['seo_descr']);
			$model->description = $post['description'];
			$model->video = $post['video'];
			$model->update();
			foreach(ARR::get($post, 'sort', array()) as $k => $v)
			{
				$sort_item = ORM::factory('Good', $k);
				$sort_item->sort = $v;
				$sort_item->update();
			}
			$this->redirect('/admin/categories/edit/'.$model->id);			
		}
		$data = array(
				'item' => $model,
				'goods' => $model->goods->order_by('sort')->find_all(),
				'videos' => $videos
		);

		$this->render($data);
	}
	
	public function action_editage()
	{
		$id = $this->request->param('id');
		$model = ORM::factory('Age', $id);
		if(!$model->loaded())
			$this->redirect('/admin/categories');

		$post = $this->request->post();
		if(!empty($post))
		{
			$model->title = htmlspecialchars($post['title']);
			$model->description = $post['description'];
			$model->update();
			$this->redirect('/admin/categories/editage/'.$model->id);			
		}
		$data = array(
				'item' => $model,
		);

		$this->render($data);
	}

}
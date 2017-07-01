<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Pages extends Controller_Admin
{

	public function before()
	{
		parent::before();
		$this->template->sidebar = Request::factory('/admin/sidebar/pages')->execute();
		$this->template->scripts = array('https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.7.1/ckeditor.js');
	}

	public function action_index()
	{
		$this->render();
	}

	public function action_edit()
	{
		$id = $this->request->param('id');
		$model = ORM::factory('Pages', $id);
		if(!$model->loaded())
			$this->redirect('/admin');

		$post = $this->request->post();
		if(!empty($post))
		{
			$model->title = htmlspecialchars($post['title']);
			$model->seo_title = htmlspecialchars($post['seo_title']);
			$model->seo_keywords = htmlspecialchars($post['seo_keywords']);
			$model->seo_descr = htmlspecialchars($post['seo_descr']);
			$model->body = $post['description'];
			$model->update();
			$this->redirect('/admin/pages/edit/'.$model->id);
		}
		$data = array(
				'item' => $model,
		);

		$this->render($data);
	}

}
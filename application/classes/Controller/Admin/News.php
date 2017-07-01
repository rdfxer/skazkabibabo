<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_News extends Controller_Admin
{

	public function before()
	{
		parent::before();
		$this->template->sidebar = Request::factory('/admin/sidebar/news')->execute();
		$this->template->scripts = array('https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.7.1/ckeditor.js');
	}

	public function action_index()
	{
		$this->render();
	}

	public function action_edit()
	{
		$id = $this->request->param('id');
		$model = ORM::factory('News', $id);
		$post = $this->request->post();
		if(!empty($post))
		{
			$model->text = $post['text'];
			$model->title = $post['title'];
			$model->status = Arr::get($post, 'status', '0');
			$model->update();
			$this->redirect('/admin/news/edit/'.$id);
		}
		
		$data = array(
				'item' => $model
		);
		$this->render($data);
	}

	public function action_add()
	{
		$model = ORM::factory('News');
		$post = $this->request->post();
		if(!empty($post))
		{
			$model->text = $post['text'];
			$model->title = $post['title'];
			$model->date = time();			
			$model->status = Arr::get($post, 'status', '0');
			$model->save();
			$id = $model->reload()->id;
			$this->redirect('/admin/news/edit/'.$id);
		}
		
		$data = array(
		);
		$this->render($data);
	}
	
	

}
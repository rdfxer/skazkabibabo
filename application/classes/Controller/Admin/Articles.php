<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Articles extends Controller_Admin
{

	public function before()
	{
		parent::before();
		$this->template->sidebar = Request::factory('/admin/sidebar/articles')->execute();
		$this->template->scripts = array('https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.7.1/ckeditor.js');
	}

	public function action_index()
	{
		$this->render();
	}

	public function action_edit()
	{
		$id = $this->request->param('id');
		$model = ORM::factory('Article', $id);
		$cmodel = ORM::factory('Articlescat')->find_all();
		if(!$model->loaded())
			$this->redirect('/admin/articles/add');

		$post = $this->request->post();
		if(!empty($post))
		{
			$model->title = htmlspecialchars($post['title']);
			$model->seo_title = htmlspecialchars($post['seo_title']);
			$model->seo_keywords = htmlspecialchars($post['seo_keywords']);
			$model->seo_descr = htmlspecialchars($post['seo_descr']);
			$model->intro = htmlspecialchars($post['intro']);
			$model->cat_id = $post['cat_id'];
			$model->description = $post['description'];
			$model->status = Arr::get($post, 'status', '0');
			$model->update();
			$dir = DOCROOT.'static/upload/articles/';
			if(!empty($_FILES['image']['name']))
			{
				$fname = $id.'.jpg';
				$img = Upload::save($_FILES['image'], $fname.'.jpg', DOCROOT.'tmp/');
				if($img)
				{
					$imgFactory = Image::factory($img);
					$imgFactory->resize(150, 150, Image::AUTO)
						->save($dir.'/'.$fname);
					unlink($img);
				}
			}
			$this->redirect('/admin/articles/edit/'.$model->id);
		}
		$data = array(
				'item' => $model,
				'cat' => $cmodel,
		);

		$this->render($data);
	}

	public function action_add()
	{
		$model = ORM::factory('Article');
		$cmodel = ORM::factory('Articlescat')->find_all();
		$post = $this->request->post();
		if(!empty($post))
		{
			$model->title = htmlspecialchars($post['title']);
			$model->seo_title = htmlspecialchars($post['seo_title']);
			$model->seo_keywords = htmlspecialchars($post['seo_keywords']);
			$model->seo_descr = htmlspecialchars($post['seo_descr']);
			$model->intro = htmlspecialchars($post['intro']);
			$model->cat_id = $post['cat_id'];
			$model->date_added = time();
			$model->description = $post['description'];
			$model->status = Arr::get($post, 'status', '0');
			$model->save();
			$id = $model->reload()->id;
			$dir = DOCROOT.'static/upload/articles/';
			if(!empty($_FILES['image']['name']))
			{
				$fname = $id.'.jpg';
				$img = Upload::save($_FILES['image'], $fname.'.jpg', DOCROOT.'tmp/');
				if($img)
				{
					$imgFactory = Image::factory($img);
					$imgFactory->resize(150, 150, Image::AUTO)
						->save($dir.'/'.$fname);
					unlink($img);
				}
			}
			$this->redirect('/admin/articles/edit/'.$model->id);
		}
		$data = array(
				'cat' => $cmodel,
		);
		$this->render($data);
	}

}
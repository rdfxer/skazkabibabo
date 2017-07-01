<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Video extends Controller_Admin
{

	public function before()
	{
		parent::before();
		$this->template->sidebar = Request::factory('/admin/sidebar/video')->execute();
		$this->template->scripts = array('https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.7.1/ckeditor.js');
	}

	public function action_index()
	{
		$this->render();
	}

	public function action_edit()
	{
		$id = $this->request->param('id');
		$model = ORM::factory('Video', $id);
		if(!$model->loaded())
			$this->redirect('/admin/video/add');

		$post = $this->request->post();
		if(!empty($post))
		{
			$model->title = htmlspecialchars($post['title']);
			$model->seo_title = htmlspecialchars($post['seo_title']);
			$model->seo_title = htmlspecialchars($post['seo_keywords']);
			$model->seo_title = htmlspecialchars($post['seo_descr']);
			$model->description = $post['description'];
			$model->status = Arr::get($post, 'status', '0');
			$model->update();
			$this->redirect('/admin/video/edit/'.$model->id);
		}
		$data = array(
				'item' => $model,
		);

		$this->render($data);
	}

	public function action_add()
	{
		$model = ORM::factory('Video');
		$post = $this->request->post();
		if(!empty($post))
		{
			$model->title = htmlspecialchars($post['title']);
			$model->date_added = time();
			$model->seo_title = htmlspecialchars($post['seo_title']);
			$model->seo_keywords = htmlspecialchars($post['seo_keywords']);
			$model->seo_descr = htmlspecialchars($post['seo_descr']);
			$model->description = $post['description'];
			parse_str(parse_url($post['video'], PHP_URL_QUERY));
			$model->video = $v;
			$model->status = Arr::get($post, 'status', '0');
			$model->save();
			$videoID = $model->reload();
			$filename = $videoID->id.'.jpg';
			$locpath = DOCROOT.'static/upload/video/'.$filename;

			$ch = curl_init('http://img.youtube.com/vi/'.$videoID->video.'/0.jpg');
			$fp = fopen($locpath, 'wb');
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_exec($ch);
			curl_close($ch);
			fclose($fp);

			Image::factory($locpath)->resize(300, NULL)
				->save($locpath);

			$model->update();
			$this->redirect('/admin/video/edit/'.$model->id);
		}
		$data = array(
				'item' => $model,
		);

		$this->render($data);
	}

}
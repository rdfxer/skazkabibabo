<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Index extends Controller_Admin
{

	public function before()
	{
		parent::before();
		$this->template->sidebar = Request::factory('/admin/sidebar/goods')->execute();
		$this->template->scripts = array('https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.7.1/ckeditor.js');
	}

	public function action_index()
	{
		$this->render();
	}

	public function action_edit()
	{
		$id = $this->request->param('id', false);
		if(!$id)
			$this->redirect('/admin/index/add');

		$model = ORM::factory('Good', $id);
		$ages = ORM::factory('Age')->find_all();
		if(!$model->loaded())
			$this->redirect('/admin/index/add');
		$alike_arr = explode('::', $model->goods_alike);
		$price = explode('.', number_format($model->price / 100, 2, '.', ''));
		$dir = DOCROOT.'static/upload/goods/'.$model->id;
		if(!file_exists($dir))
			mkdir($dir);
		if(!file_exists($dir.'/s'))
			mkdir($dir.'/s');
		if(!file_exists($dir.'/ss'))
			mkdir($dir.'/ss');

		$images = scandir($dir);
		$post = $this->request->post();
		if(!empty($post))
		{
			$model->title = htmlspecialchars($post['title']);
			$model->seo_title = htmlspecialchars($post['seo_title']);
			$model->seo_keywords = htmlspecialchars($post['seo_keywords']);
			$model->seo_descr = htmlspecialchars($post['seo_descr']);
			$model->goods_alike = implode('::', Arr::get($post, 'alike', array()));
			$model->description = $post['description'];
			$model->cat_id = $post['category'];
			$model->status = Arr::get($post, 'status', '0');
			$model->price = ($post['price_r'] * 100) + $post['price_k'];
			$model->intro = htmlspecialchars($post['intro']);
			$model->remove('ages');
			$imgmain = NULL;
			foreach(Arr::get($post, 'age', array()) as $age) $model->add('ages', $age);
			$filename = time();
			if(!empty($_FILES['image']['name'][0]))
			{
				if(is_null(Arr::get($post, 'main_photo')))
					$imgmain = $filename.'.jpg';
				foreach($this->splitfiles($_FILES['image']) as $ik => $iv)
				{
					$fname = $filename + $ik;
					$img = Upload::save($iv, $fname.'.jpg', DOCROOT.'tmp/');
					if($img)
					{
						$imgFactory = Image::factory($img);
						if($imgFactory->width > 700 || $imgFactory->height > 700)
						{
							$imgFactory->resize(700, 700, Image::AUTO)
								->save($dir.'/'.$fname.'.jpg');
						}
						else
							$imgFactory->save($dir.'/'.$fname.'.jpg');

						$imgFactory->resize(300, 300, Image::AUTO)
							->save($dir.'/s/'.$fname.'.jpg');
						$imgFactory->resize(100, 100, Image::AUTO)
							->save($dir.'/ss/'.$fname.'.jpg');
						unlink($img);
					}
				}
			}
			if(!is_null(Arr::get($post, 'main_photo')))
				$imgmain = Arr::get($post, 'main_photo');
			$model->img_main = $imgmain;
			$model->update();
			if(key_exists('delimage', $post))
			{
				foreach($post['delimage'] as $delimagerow)
				{
					if(file_exists($dir.'/s/'.$delimagerow))
						unlink($dir.'/s/'.$delimagerow);
					if(file_exists($dir.'/ss/'.$delimagerow))
						unlink($dir.'/ss/'.$delimagerow);
					if(file_exists($dir.'/'.$delimagerow))
						unlink($dir.'/'.$delimagerow);
				}
			}
			$this->redirect('/admin/index/edit/'.$model->id);
		}
		$data = array(
				'item' => $model,
				'cat' => ORM::factory('Categories')->find_all(),
				'alike' => $alike_arr,
				'ages' => $ages,
				'price' => $price,
				'images' => $images,
		);

		$this->render($data);
	}

	public function action_add()
	{
		$model = ORM::factory('Good');
		$ages = ORM::factory('Age')->find_all();
		$videos = ORM::factory('Video')->where('status', '=', '1')->find_all();

		$post = $this->request->post();


		if(!empty($post))
		{
			$model->title = htmlspecialchars($post['title']);
			$model->date_added = time();
			$model->seo_title = htmlspecialchars($post['seo_title']);
			$model->seo_keywords = htmlspecialchars($post['seo_keywords']);
			$model->seo_descr = htmlspecialchars($post['seo_descr']);
			$model->goods_alike = implode('::', Arr::get($post, 'alike', array()));
			$model->description = $post['description'];
			$model->cat_id = $post['category'];
			$model->video = $post['video'];
			$model->status = Arr::get($post, 'status', '0');
			$model->price = ($post['price_r'] * 100) + $post['price_k'];
			$model->intro = htmlspecialchars($post['intro']);
			$model->save();

			$id = $model->reload()->id;
			foreach(Arr::get($post, 'age', array()) as $age) $model->add('ages', $age);
			$dir = DOCROOT.'static/upload/goods/'.$id;
			if(!file_exists($dir))
				mkdir($dir);
			if(!file_exists($dir.'/s'))
				mkdir($dir.'/s');
			if(!file_exists($dir.'/ss'))
				mkdir($dir.'/ss');
			if(!empty($_FILES['image']['name'][0]))
			{
				$filename = time();
				$model->img_main = $filename.'.jpg';
				$model->update();
				foreach($this->splitfiles($_FILES['image']) as $ik => $iv)
				{
					$fname = $filename + $ik;
					$img = Upload::save($iv, $fname.'.jpg', DOCROOT.'tmp/');
					if($img)
					{
						$imgFactory = Image::factory($img);
						if($imgFactory->width > 700 || $imgFactory->height > 700)
						{
							$imgFactory->resize(700, 700, Image::AUTO)
								->save($dir.'/'.$fname.'.jpg');
						}
						else
							$imgFactory->save($dir.'/'.$fname.'.jpg');

						$imgFactory->resize(300, 300, Image::AUTO)
							->save($dir.'/s/'.$fname.'.jpg');
						$imgFactory->resize(100, 100, Image::AUTO)
							->save($dir.'/ss/'.$fname.'.jpg');
						unlink($img);
					}
				}
			}

			if(key_exists('delimage', $post))
			{
				foreach($post['delimage'] as $delimagerow)
				{
					if(file_exists($dir.'/s/'.$delimagerow))
						unlink($dir.'/s/'.$delimagerow);
					if(file_exists($dir.'/ss/'.$delimagerow))
						unlink($dir.'/ss/'.$delimagerow);
					if(file_exists($dir.'/'.$delimagerow))
						unlink($dir.'/'.$delimagerow);
				}
			}
			$this->redirect('/admin/index/edit/'.$id);
		}
		$data = array(
				'cat' => ORM::factory('Categories')->find_all(),
				'ages' => $ages,
				'videos' => $videos
		);

		$this->render($data);
	}

}
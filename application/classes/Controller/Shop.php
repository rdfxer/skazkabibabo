<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Shop extends Controller_Front
{

	public function action_index()
	{
		$model = ORM::factory('Good');
		$url = $this->request->param('url');
		$age = $this->request->param('age');
		$descr = '';
		$agemodel = ORM::factory('Age', array('url' => $age));
		if($agemodel->loaded())
		{
			$model = $agemodel->goods;
			$descr = $agemodel->description;
		}

		$category = ORM::factory('Categories', array('url' => $url));
		if(!$category->loaded())
		{
			$list = $model->where('status', '=', '1')->order_by('sort')->find_all();
			$header = 'Все товары';
			if($agemodel->loaded())
				$header .= ': '.UTF8::strtolower($agemodel->title);
		}
		else
		{
			$list = $model->where('cat_id', '=', $category->id)->where('status', '=', '1')->order_by('sort')->find_all();
			$header = $category->title;
			$descr = $category->description;
		}
		$this->template->title = $category->seo_title.' | ';
		$this->template->description = $category->seo_descr;
		$this->template->keywords = $category->seo_keywords;
		$data = array(
				'list' => $list,
				'header' => $header,
				'description' => $descr,
				'count' => $list->count(),
				'cat' => $category
		);
		$this->render($data);
	}

	public function action_item()
	{
		$this->template->styles = array('https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/css/lightbox.min.css' => 'screen');
		$this->template->scripts = array('https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/js/lightbox.min.js');
		$item_id = $this->request->param('item');
		$model = ORM::factory('Good', $item_id);
		if(!$model->loaded() || $model->status == '0')
			throw HTTP_Exception::factory(404, 'Такой страницы нет!');
		$this->template->title = $model->title.' | ';
		$this->template->description = $model->seo_descr;
		$this->template->keywords = $model->seo_keywords;
		$dirname = DOCROOT.'static/upload/goods/'.$model->id;
		if(!file_exists($dirname))
		{
			mkdir($dirname);
			mkdir($dirname.'/s');
		}
		$imgdir = scandir($dirname);
		$images = array();
		foreach($imgdir as $imgrow)
		{
			if(strlen($imgrow) > 3)
				$images[] = $imgrow;
		}

		$alike = array();
		$alike_imgs = array();
		$alike_id_arr = explode('::', $model->goods_alike);
		if(!empty($alike_id_arr))
		{
			foreach($alike_id_arr as $alike_id)
			{
				if(is_numeric($alike_id))
				{
					$alike_model = ORM::factory('Good', $alike_id);
					if($alike_model->loaded())
					{
						$alike[] = $alike_model;
						$alike_imgs[$alike_id] = $this->main_img($alike_id);
					}
				}
			}
		}
		$data = array(
				'item' => $model,
				'images' => $images,
				'alike' => $alike,
				'alike_imgs' => $alike_imgs,
				'in_cart' => $this->in_cart($item_id)
		);
		$this->render($data);
	}

}


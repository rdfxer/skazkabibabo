<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller_Front
{

	public function action_index()
	{
		$url = $this->request->param('url');
		$cat = ORM::factory('Articlescat', array('url' => $url));
		$model = $cat->articles->where('status', '=', '1')->order_by('sort', 'ASC')->find_all();
		$this->template->title = $cat->title.' | ';
		$this->template->description = $cat->title;
		$this->template->keywords = $cat->title;
		$data = array(
				'list' => $model,
				'cat' => $cat
		);
		$this->render($data);
	}

	public function action_item()
	{
		$id = $this->request->param('id');
		$item = ORM::factory('Article', $id);
		$this->template->title = (!empty($item->seo_title)) ? $item->seo_title.' | ' : $item->title.' | ';
		$this->template->description = $item->seo_descr;
		$this->template->keywords = $item->seo_keywords;
		$data = array(
				'item' => $item
		);
		$this->render($data);
	}

}


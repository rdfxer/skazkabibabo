<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Sidebar extends Controller_Blocks
{

	public function render($data = array())
	{
		$controller = $this->request->controller();
		$action = $this->request->action();
		$file = 'admin/'.strtolower($controller).'_'.$action;
		$this->template->content = View::factory($file, $data);
		return $this->template->content;
		parent::render($data);
	}
	
	public function action_goods()
	{
		$model = ORM::factory('Categories')->order_by('sort', 'ASC')->find_all();
		$list = array();
		foreach($model as $row)
		{
			$goods = $row->goods->find_all();
			$goods_arr = array();
			foreach($goods as $g_row)
			{
				$goods_arr[$g_row->id] = array('title' => $g_row->title, 'status' => $g_row->status);
			}
			$list[$row->title] = $goods_arr;
		}
		$data = array(
				'list' => $list
		);
		$this->render($data);
	}	
	
	public function action_articles()
	{
		$model = ORM::factory('Articlescat')->find_all();
		$list = array();
		foreach($model as $row)
		{
			$art = $row->articles->find_all();
			$art_arr = array();
			foreach($art as $a_row)
			{
				$art_arr[$a_row->id] = array('title' => $a_row->title, 'status' => $a_row->status);
			}
			$list[$row->title] = $art_arr;
		}
		$data = array(
				'list' => $list
		);
		$this->render($data);
	}	
	
	public function action_video()
	{
		$model = ORM::factory('Video')->order_by('sort', 'ASC')->find_all();
		$data = array(
				'list' => $model
		);
		$this->render($data);
	}

	public function action_categories()
	{
		$model = ORM::factory('Categories')->order_by('sort', 'ASC')->find_all();
		$agemodel = ORM::factory('Age')->find_all();
		$data = array(
				'list' => $model,
				'agelist' => $agemodel
		);
		$this->render($data);
	}

	public function action_pages()
	{
		$model = ORM::factory('Pages')->find_all();
		$data = array(
				'list' => $model
		);
		$this->render($data);
	}
	
	public function action_news()
	{
		$model = ORM::factory('News')->find_all();
		$data = array(
				'list' => $model
		);
		$this->render($data);
	}


}


<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Common extends Controller_Admin
{

	public function action_index()
	{
		$model = ORM::factory('Common');
		$data = array();
		foreach($model->find_all() as $row)
		{
			$data[$row->title] = array('id' => $row->id, 'body' => $row->body);
		}
		if($this->request->post('submit'))
		{
			foreach($data as $k => $v)
			{
				if(Arr::get($this->request->post($k), false))
				{
					$mdl = ORM::factory('Common', $v['id']);
					$mdl->body = $this->request->post($k);
					$mdl->update();
					$this->redirect('/admin/common');
				}
			}
		}
		$this->render($data);
	}

}
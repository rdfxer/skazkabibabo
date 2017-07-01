<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_Front
{	
	public function action_index()
	{
		$this->template->styles = array('static/index.css' => 'screen');
		$data = array();
		$this->render($data);
	}


}


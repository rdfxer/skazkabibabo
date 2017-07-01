<?php

class Layout extends Controller_Template
{

	protected $_model;
	protected $_id;
	protected $_auth;
	protected $_session;
	protected $_post;

	public function before()
	{
		parent::before();
		Request::current()->headers = array('Cache-Control' => 'no-store', 'Pragma' => 'no-cache');
		$this->_id = $this->request->param('id');
		$this->_auth = Auth::instance();
		$this->_session = Session::instance();
		$this->_post = $this->request->post();
	}

	public function after()
	{
		parent::after();
	}

}
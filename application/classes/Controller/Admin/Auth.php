<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Auth extends Controller
{

	public function action_login()
	{
		if($this->request->post())
		{
			$post = $this->request->post();
			$success = Auth::instance()->login($post['login'], $post['password']);
			if($success)
			{
				$this->redirect('/admin');
			}
			else
			{
				echo 'Имя пользователя или пароль введены неверно';
			}
		}

		$this->response->body(View::factory('admin/login_index'));
	}
	
	public function action_logout()
	{
		Session::instance()->delete('auth_user');
		$this->redirect('/');
	}

}
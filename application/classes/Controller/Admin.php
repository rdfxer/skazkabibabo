<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Layout
{

	public $template = 'layout/admin';
	protected $mainModel;

	public function before()
	{
		parent::before();
		Request::current()->headers = array('Cache-Control' => 'no-store', 'Pragma' => 'no-cache');

		if(!Auth::instance()->logged_in())
			$this->redirect('login');


		if($this->auto_render)
		{
			$this->template->styles = array();
			$this->template->scripts = array();
			$this->template->title = 'Панель управления';
			$this->template->meta_keywords = '';
			$this->template->meta_description = '';
			$this->template->meta_copywrite = '';
			$this->template->content = '';
			$this->template->topmenu = '';
			$this->template->sidebar = '';
		}
	}

	public function striptags($key, $accepted = TRUE)
	{
		if($accepted)
		{
			$accepted = '<em><p><a><b><i><u><img><br><hr><ul><ol><li><strong><span>';
			$output = strip_tags(Request::initial()->post($key), $accepted);
		}
		else
		{
			$output = strip_tags(Request::initial()->post($key));
		}
		return $output;
	}

	/**
	 * Автоматически рендерит контроллер во вьюху вида "dir/controller/action".
	 *
	 * @chainable
	 * @param   array   $data     Массив для передачи данных во вьюху
	 * @return  Контейнер "content"
	 */
	public function render($data = array())
	{
		$controller = $this->request->controller();
		$action = $this->request->action();
		$file = 'admin/'.strtolower($controller).'_'.$action;
		$this->template->content = View::factory($file, $data);
		return $this->template->content;
	}

	/**
	 * Удаляет элемент
	 *
	 * @chainable
	 * @param   string   $model     Имя модели
	 * @return  true
	 */
	public function delete($model)
	{
		$id = $this->request->param('id');
		if($id != NULL)
		{
			$model = ORM::factory($model, $id);
			if($model->delete())
			{
				Hint::set('success', 'Успешно удалено');
			}
		}
		$this->request->redirect('/admin/'.$this->request->controller());
	}

	/**
	 * Активирует или деактивирует элемент (ставит маркер active).
	 *
	 * @chainable
	 * @param   string   $model     Имя модели
	 * @return  true
	 */
	public function active($model)
	{
		$id = $this->request->param('id');
		if($id != NULL)
		{
			$model = ORM::factory($model, $id);
			if($model->active == '1')
			{
				$model->active = '0';
				Hint::set('success', 'Успешно деактивировано');
			}
			else
			{
				$model->active = '1';
				Hint::set('success', 'Успешно активировано');
			}
			$model->update();
		}
		$this->request->redirect('/admin/'.$this->request->controller());
	}

	/**
	 * Определяет, задан ли в адресной строке параметр "id". Если нет, переадресует на дефолтный экшн.
	 *
	 * @chainable
	 * @return id
	 */
	public function has_id()
	{
		$id = $this->request->param('id');
		if($id == NULL)
			$this->request->redirect('/admin/'.$this->request->controller());
		return $id;
	}

	protected function topmenu()
	{
		return array(
				'/index' => 'Товары',
				'/categories' => 'Категории',
				'/pages' => 'Страницы',
				'/articles' => 'Статьи',
				'/video' => 'Видео',
				'/news' => 'Новости',
				'/common' => 'Hастройки'
		);
	}

	protected function splitfiles($arr)
	{
		$o = array();
		foreach($arr as $k => $v) // $k = 'name'
		{
			foreach($v as $num => $row)
			{
				$o[$num][$k] = $row;
			}
		}
		return $o;
	}

	public function after()
	{
		if($this->auto_render)
		{
			$styles = array(
					'static/admin.css' => 'screen',
					'static/bootstrap.css' => 'screen',
			);
			$scripts = array(
					'https://yastatic.net/bootstrap/2.3.2/js/bootstrap.min.js',
					'https://yastatic.net/jquery/1.11.1/jquery.min.js',
			);

			$this->template->styles = array_reverse(array_merge($this->template->styles, $styles));
			$this->template->scripts = array_reverse(array_merge($this->template->scripts, $scripts));
			$this->template->topmenu = $this->topmenu();
			$this->template->footer = Request::factory('block/index/footer')->execute();
		}
		parent::after();
	}

}
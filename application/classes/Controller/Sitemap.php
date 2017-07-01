<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Sitemap extends Controller
{

	public function before()
	{
		parent::before();
		$this->response->headers('content-type', 'text/xml');
	}

	public function action_index()
	{
		$cache = Cache::instance('file');
		$response = $cache->get('sitemap');
		
		if($response === NULL)
		{
			$model_goods = ORM::factory('Good')->where('status', '=', '1')->find_all();
			$model_cat = ORM::factory('Categories')->find_all();
			$model_articles = ORM::factory('Article')->where('status', '=', '1')->find_all();
			$model_articlescat = ORM::factory('Articlescat')->find_all();
			$model_video = ORM::factory('Video')->where('status', '=', '1')->find_all();

			$sitemap = new Sitemap;
			$url = new Sitemap_URL;

			$url->set_loc(URL::base())->set_priority('1');
			$sitemap->add($url);
			$url->set_loc(URL::base().'news')->set_priority('0.9');
			$sitemap->add($url);
			$url->set_loc(URL::base().'contacts')->set_priority('0.9');
			$sitemap->add($url);
			$url->set_loc(URL::base().'video')->set_priority('0.9');
			$sitemap->add($url);
			$url->set_loc(URL::base().'oplata')->set_priority('0.9');
			$sitemap->add($url);
			$url->set_loc(URL::base().'bonus')->set_priority('0.9');
			$sitemap->add($url);

			foreach($model_cat as $cat_row)
			{
				$url->set_loc(URL::base().'shop/'.$cat_row->url)->set_priority('0.9');
				$sitemap->add($url);
			}
			foreach($model_goods as $good_row)
			{
				$url->set_loc(URL::base().'shop/'.$good_row->id)->set_priority('0.8');
				$sitemap->add($url);
			}
			foreach($model_articlescat as $ac_row)
			{
				$url->set_loc(URL::base().$ac_row->url)->set_priority('0.9');
				$sitemap->add($url);
			}
			foreach($model_articles as $a_row)
			{
				$url->set_loc(URL::base().$a_row->cats->url.'/'.$a_row->id)->set_priority('0.8');
				$sitemap->add($url);
			}
			foreach($model_video as $v_row)
			{
				$url->set_loc(URL::base().'video/'.$v_row->id)->set_priority('0.8');
				$sitemap->add($url);
			}

			$response = $sitemap->render();
			$cache->set('sitemap', $response, 86400);
		}

		echo $response;
	}

}
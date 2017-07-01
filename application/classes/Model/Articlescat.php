<?php
defined('SYSPATH') or die('No direct script access.');

class Model_Articlescat extends ORM
{

	protected $_table_name = 'articles_cat';

	protected $_has_many = array(
			'articles' => array('model' => 'Article', 'foreign_key' => 'cat_id')
	);
}
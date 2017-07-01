<?php
defined('SYSPATH') or die('No direct script access.');

class Model_Article extends ORM
{

	protected $_table_name = 'articles';
	protected $_belongs_to = array(
			'cats' => array('model' => 'Articlescat', 'foreign_key' => 'cat_id')
	);

}
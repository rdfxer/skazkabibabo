<?php
defined('SYSPATH') or die('No direct script access.');

class Model_Good extends ORM
{

	protected $_table_name = 'goods';
	protected $_has_many = array(
			'ages' => array('model' => 'Age', 'through' => 'good_age')
	);
/*	protected $_belongs_to = array(
			'cats' => array('model' => 'Categories', 'foreign_key' => 'cat_id')
	);*/

}
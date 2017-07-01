<?php
defined('SYSPATH') or die('No direct script access.');

class Model_Categories extends ORM
{

	protected $_table_name = 'categories';
	protected $_has_many = array(
			'goods' => array('model' => 'Good', 'foreign_key' => 'cat_id')
	);

}
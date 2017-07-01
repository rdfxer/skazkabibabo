<?php
defined('SYSPATH') or die('No direct script access.');

class Model_Age extends ORM
{

	protected $_table_name = 'ages';
		
	protected $_has_many = array(
		'goods' => array('model' => 'Good','through' => 'good_age'),
	);

}
<?php
defined('SYSPATH') or die('No direct script access.');

class Model_Orderstatus extends ORM
{

	protected $_table_name = 'orders_status';
	
	protected $_has_many = array(
			'stat' => array(
					'model' => 'Order',
					'foreign_key' => 'status',
			),
	);

}
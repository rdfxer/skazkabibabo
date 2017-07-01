<?php
defined('SYSPATH') or die('No direct script access.');

class Model_Order extends ORM
{

	protected $_table_name = 'orders';
	
	protected $_belongs_to = array(
			'stat' => array(
					'model' => 'Orderstatus',
					'foreign_key' => 'status',
			),
	);

}
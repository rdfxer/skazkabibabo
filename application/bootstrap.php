<?php
defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------
// Load the core Kohana class
require SYSPATH.'classes/Kohana/Core'.EXT;

if(is_file(APPPATH.'classes/Kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/Kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/Kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('Europe/Moscow');

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
setlocale(LC_ALL, 'ru_RU.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @link http://kohanaframework.org/guide/using.autoloading
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Optionally, you can enable a compatibility auto-loader for use with
 * older modules that have not been updated for PSR-0.
 *
 * It is recommended to not enable this unless absolutely necessary.
 */
//spl_autoload_register(array('Kohana', 'auto_load_lowercase'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('ru-ru');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if(isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - integer  cache_life  lifetime, in seconds, of items cached              60
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 * - boolean  expose      set the X-Powered-By header                        FALSE
 */
Kohana::init(array(
		'base_url' => 'http://lera.local',
		'errors' => true,
		'index_file' => '',
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);
Cookie::$salt = 'wehavecookies';
Cookie::$expiration = Date::DAY;
/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
		'auth' => MODPATH.'auth',
		'sitemap'      => MODPATH.'sitemap',
		'email'  => MODPATH.'email',
		'database' => MODPATH.'database',
		'image' => MODPATH.'image',
		'captcha' => MODPATH.'captcha',
		'orm' => MODPATH.'orm', 
		'cache' => MODPATH.'cache', 
));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
 Route::set('captcha', 'captcha(/<group>)')
	->defaults(array(
		'controller' => 'captcha',
		'action' => 'index',
		'group' => NULL));
        
Route::set('auth', '<action>', array('action' => 'login|logout'))
	->defaults(array(
			'directory' => 'admin',
			'controller' => 'auth'
	));

Route::set('ajax', 'ajax(/<action>(/<id>))')
	->defaults(array(
			'controller' => 'ajax'
	));

Route::set('cart', 'cart(/<action>)')
	->defaults(array(
			'controller' => 'cart',
			'action' => 'index'
	));

Route::set('admin', 'admin(/<controller>(/<action>(/<id>)))')
	->defaults(array(
			'directory' => 'admin',
			'controller' => 'index',
			'action' => 'index',
	));

Route::set('error', 'error/<action>(/<message>)', array('action' => '[0-9]++', 'message' => '.+'))
	->defaults(array(
			'directory' => 'Error',
			'controller' => 'Handler',
			'action' => '404'
	));

Route::set('articles_item', '<url>/<id>', array('id' => '[0-9]++', 'url' => 'sdelay-sam|rech|sadikam|etap-rech'))
	->defaults(array(
			'controller' => 'articles',
			'action' => 'item',
	));

Route::set('articles', '<url>', array('url' => 'sdelay-sam|rech|sadikam|etap-rech'))
	->defaults(array(
			'controller' => 'articles',
			'action' => 'index',
	));

Route::set('shop_byage', 'shop/age/<age>')
	->defaults(array(
			'controller' => 'shop',
			'action' => 'index',
	));

Route::set('static_pages', '<url>', array('url' => 'oplata|contacts|bonus'))
	->defaults(array(
			'controller' => 'pages',
			'action' => 'index',
	));

Route::set('shop_item', 'shop/<item>', array('item' => '[0-9]++'))
	->defaults(array(
			'controller' => 'shop',
			'action' => 'item',
	));


Route::set('video_item', 'video/<id>', array('id' => '[0-9]++'))
	->defaults(array(
			'controller' => 'video',
			'action' => 'item',
	));


Route::set('widgets', 'widgets(/<action>)')
	->defaults(array(
			'controller' => 'widgets'
	));

Route::set('shop', 'shop(/<url>(/age/<age>))')
	->defaults(array(
			'controller' => 'shop',
			'action' => 'index',
	));

Route::set('default1', '(<controller>(/<id>))')
	->defaults(array(
			'controller' => 'index',
			'action' => 'index',
	));
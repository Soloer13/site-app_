<<?php 

	defined('DS') ? null : define('DS', DIRECTROY_SEPERATOR);
	defined('SITE_ROOT') ? null : define('SITE', DS . 'xampp'.DS.'htdocs'.DS.'masirah'.DS.'site-app'.DS.'api')
	//C:\xampp\htdocs\masirah\site-app\api\includes
	defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');
	defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core');

	//load config file first
	require_once(INC_PATH.DS.'config.php');

	//core classes
	require_once(CORE_PATH.DS.'core')
 ?>
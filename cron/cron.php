<?php
date_default_timezone_set('America/New_York');
set_time_limit(0);
$starttime = microtime(true);

function __autoload($classname)
{
	include_once(Conf::$classes[strtolower($classname)]);
}

require_once '../config.php';
require_once Conf::$document_root.'/classes/croncontroller.class.php'; 
require_once Conf::$document_root.'/classes/basemodel.class.php';
require_once Conf::$document_root.'/classes/baseview.class.php';
require_once Conf::$document_root.'/classes/cronview.class.php';

$params = CronController::_getParam($_SERVER, 'argv', array());
if (!empty($params) && !empty($params[1]))
{
	$args = array();
	$len = count($params);
	for ($i=2;$i<$len;++$i) $args[] = $params[$i];
	
	CronController::_init($args);
	CronController::_execModule($params[1]);
}
else echo 'Incorrect parameters';

$endtime = microtime(true);
echo "\n".'Script duration : '.($endtime-$starttime)." sec\n";
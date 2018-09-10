<?php
date_default_timezone_set('America/New_York');

function __autoload($classname)
{
	include_once(Conf::$classes[strtolower($classname)]);
}

require_once 'config.php';

require_once Conf::$document_root.'/classes/basecontroller.class.php'; 
require_once Conf::$document_root.'/classes/basemodel.class.php';
require_once Conf::$document_root.'/classes/baseview.class.php';
require_once Conf::$document_root.'/classes/framework.class.php';

$core = new Framework();
echo $core->run();

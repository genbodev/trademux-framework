<?php

/**
 * Toolkit for generating framework modules
 */

$params = $_SERVER['argv'];
if (empty($params) || empty($params[1])) die("No params specified\n");

$modulename = $params[1];

mkdir('modules/'.strtolower($modulename), 02775, true);
if (!in_array('-notpl', $params)) mkdir('modules/'.strtolower($modulename).'/tpl', 02775, true);
if (in_array('+js', $params)) mkdir('modules/'.strtolower($modulename).'/js', 02775, true);


$controllertemplate = '<?php

class '.ucfirst($modulename).' extends BaseController
{
	public function index()
	{
		'.(!in_array('notpl', $params) ? '$this->v->display(\'index\');' : '').'
	}
}';

$modeltemplate = '<?php

class '.ucfirst($modulename).'Model extends BaseModel
{
	
}';

$viewtemplate = '<?php

class '.ucfirst($modulename).'View extends BaseView
{
}';

$jstemplate = '$(function() 
{
	
});
';

file_put_contents('modules/'.strtolower($modulename).'/'.strtolower($modulename).'.php', $controllertemplate);
file_put_contents('modules/'.strtolower($modulename).'/'.strtolower($modulename).'.m.php', $modeltemplate);
file_put_contents('modules/'.strtolower($modulename).'/'.strtolower($modulename).'.v.php', $viewtemplate);
file_put_contents('modules/'.strtolower($modulename).'/tpl/index.tpl.php', '');
if (in_array('+js', $params)) file_put_contents('modules/'.strtolower($modulename).'/js/index.js', $jstemplate);

echo "Done\n";
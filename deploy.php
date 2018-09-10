<?php

function classesMap($path)
{
	$classes = array();
	
	$files = glob($path.'*.class.php', GLOB_NOSORT);
	foreach ($files as $file)
	{
		$class = substr($file, strrpos($file, '/')+1);
		$key = substr($class, 0, strpos($class, '.'));
		$classes[$key] = $file;
	}
	
	$folders = glob($path.'*', GLOB_ONLYDIR|GLOB_NOSORT);
	foreach ($folders as $dir)
	{
		$classes = array_merge($classes, classesMap($dir.'/'));
	}
	
	return $classes;
}

function saveMapConfig($map)
{
	$s = 'array(';
	foreach ($map as $class => $path)
	{
		$s .= '"'.$class.'"=>"'.$path.'",';
	}
	$s = rtrim($s, ',');
	$s .= ');';
	
	$config = file_get_contents('config.php');
	$config = preg_replace('/public\s+static\s+\$classes\s*=.*?;/si', 'public static $classes = '.$s, $config);
	file_put_contents('config.php', $config);	
}

function modulesMVCMerge($path)
{
	$modulename = substr($path, strrpos($path, '/')+1);
	$modulefile = $path.'/'.$modulename.'.php';
	if (file_exists($modulefile) && $handle = opendir($path))
	{
		$s = '';
		$files = array();
    	while (false !== ($file = readdir($handle)))
        {
        	// file search searches files in order as is on disk, so ..
        	if (strtolower(substr($file, -4)) == '.php') $files[] = $path.'/'.$file;
        }
        closedir($handle);
        // child classes must have "bigger" name than parents to prevent extend of unknown class
        sort($files);
        foreach ($files as $file) 
        {
        	$content = trim(file_get_contents($file));
        	$content = preg_replace('/^<\?[ph]{0,3}/smi', '', $content);
        	$content = preg_replace('/\?>$/smi', '', $content);
        	$s .= $content."\n\n";
        	unlink($file);
        }
        file_put_contents($modulefile, "<?php\n".$s);
	}
}

function packModules($path)
{
	$folders = glob($path.'/modules/*', GLOB_ONLYDIR|GLOB_NOSORT);
	foreach ($folders as $dir)
	{
		modulesMVCMerge($dir);
		if (is_dir($dir.'/modules')) packModules($dir);
	}
}

function doMacro($file)
{
	$s = file_get_contents($file);
	$s = preg_replace('/\/\* EXCLUDE>.*?<EXCLUDE \*\//s', '', $s);
	$s = preg_replace('/\/\* INCLUDE>/s', '', $s);
	$s = preg_replace('/<INCLUDE \*\//s', '', $s);
	file_put_contents($file, $s);
}

saveMapConfig(classesMap('classes/'));

packModules('.');

doMacro('classes/basecontroller.class.php');

echo "Done.\n";
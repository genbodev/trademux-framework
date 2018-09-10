<?php
	$i = 0;
	foreach ($links as $key=>$val)
	{
		echo '<div class="dashboard"><a href="'.$this->url($key).'"><img src="'.Conf::$site.'/images/'.$val['icon'].'"><br />'.$val['title'].'</a></div>';
		$i++;
	}
?>
<div style="clear: both;"></div>
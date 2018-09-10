<ul class="navbar">
<?php
	foreach ($links as $key=>$v)
	{
		if (is_array($v)) echo '<li><a href="'.$this->url($module, $v[0]).'"'.(in_array($active, $v) ? ' class="active"' : '').'>'.$key.'</a></li>';
		else echo '<li><a href="'.$v.'"'.($module == $v ? ' class="active"' : '').'>'.$key.'</a></li>';
	}
?>
</ul>
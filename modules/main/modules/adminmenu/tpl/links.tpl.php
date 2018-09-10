<ul class="navbar">
<?php
	foreach ($links as $key=>$value)
	{
		echo '<li><a href="'.$this->url($key).'"'.($key == $active ? ' class="active"' : '').'>'.$value.'</a></li>';
	}
?>
</ul>
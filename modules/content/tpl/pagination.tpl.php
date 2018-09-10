<?php
if ($totalpages > 1)
{
?>
<div>
<?php 
for ($i = 0; $i < $totalpages; $i++)
{
	if ($page == $i) echo ' <b>'.($i+1).'</b> ';
	else echo '<a href="'.$href.'&page='.$i.'">'.($i+1).'</a>';
}
?>
</div>
<?php
} 
?>
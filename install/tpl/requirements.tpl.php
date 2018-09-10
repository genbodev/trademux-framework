<h1>Required system configuration settings</h1>
<div class="admin-inner">
<table>
<?php
$false = false;
foreach ($phpOptions as $val)
{
	if ($val['state'] == 'No') $false = true;
	echo '<tr><td width="170">'.$val['label'].'</td><td class="'.($val['state'] == 'Yes' ? 'green' : 'red').'">'.$val['state'].'</td></tr>';
}
?>
</table>
</div>
<br>
<?php 
if (!$false)
{
?>
<a class="button" href="index.php?t=db">Next</a>
<?php
}
?>
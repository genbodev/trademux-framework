<form method="post" action="<?php echo $this->url('accessmanager', 'set', array('id'=>$id, 'type'=>$typeurl)); ?>">
<? echo $desc; ?>
<div>Access map:</div>
<table class="accessmap">
<tr><?php echo $head; ?></tr>
<?php echo $permissionstable; ?>
</table>
<input type="submit" value="Set" />&nbsp;
<a href="<?php echo $this->url('accessmanager', '', array('type'=>$typeurl)); ?>" class="button" type="button">Back</a>
</form>
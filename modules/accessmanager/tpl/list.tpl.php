<h1 style="font-weight: normal;">
<a href="<?php echo $this->url('accessmanager', '', array('type'=>'roles')); ?>" <?=$this->chk($this->type, 'roles', 'class="current"');?>>Roles</a>
&nbsp;&nbsp;
<a href="<?php echo $this->url('accessmanager', '', array('type'=>'users')); ?>"<?=$this->chk($this->type, 'users', 'class="current"');?>>Users</a>
</h1>
<?=$listtable?>
<br>
<a type="button" href="<?php echo $this->url('accessmanager', 'add', array('type'=>$this->type)); ?>">Add</a>
<script src="<?=Conf::$site?>/modules/accessmanager/js/<?=$this->type?>.js"></script>
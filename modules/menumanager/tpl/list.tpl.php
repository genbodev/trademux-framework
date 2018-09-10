<?php if (!empty($name)) {?> 
<h1>
	<a style="float: right;" href="<?=$this->url('menumanager', 'index', array('parent_id'=>$this->chk($parent_id_of_parent)))?>" class="clear">
		<img src="images/up.png" title="Level Up" alt="Level Up"/>
	</a>
	<?=$name?>
</h1>
<?php 
}
?>
<div class="message"><?=$this->chk($message)?></div>
<table class="datatable tablesorter">
 <thead>
  <tr>
	<th>Title</th>
	<th sort="no" width="30"></th>
	<th width="200">Type</th>
	<th sort="no" width="90">Sort Order</th>
	<th sort="no" width="30">
		<a href="<?=$this->url('menumanager', 'edit', array('id'=>'-1', 'parent_id'=>$parent_id))?>" class="clear">
		<img src="images/add.png" title="Add" alt="Add"/>
		</a>
	</th>
  </tr>
 </thead>
 <tbody>
<?php
foreach ($data as $key=>$val)
{
?>
  <tr>
	<td>
		<a href="<?=$this->url('menumanager', 'edit', array('id'=>$this->chk($val, 'id'), 'parent_id'=>$parent_id))?>">
		<?=$this->chk($val, 'title')?>
		</a>
	</td>
	<td class="aligncenter" width="30">
		<a href="<?=$this->url('menumanager', 'index', array('parent_id'=>$this->chk($val, 'id')))?>" class="clear">
		<img src="images/submenu.png" title="Submenu" alt="Submenu"/>
		</a>
	</td>
	<td>
		<?=$this->chk($val, 'type')?>
	</td>
	<td style="text-align:left;">
		<a href="<?=$this->url('menumanager', 'reorder', array( 'id'=>$this->chk($val, 'id'), 'parent_id'=>$parent_id, 
																'order'=>$this->chk($val, 'sort_order')-1));
				 ?>"><img src="<?=Conf::$site;?>/images/uparrow.png" /></a>
		<a href="<?=$this->url('menumanager', 'reorder', array( 'id'=>$this->chk($val, 'id'), 'parent_id'=>$parent_id, 
																'order'=>$this->chk($val, 'sort_order')+1));
				 ?>"><img src="<?=Conf::$site;?>/images/downarrow.png" /></a>
		<input type="text" class="tiny changeorder" value="<?=$this->chk($val, 'sort_order');?>"/>
		<a class="saveorder" style="display:none;" href="<?=$this->url('menumanager', 'reorder', 
														array('id'=>$this->chk($val, 'id'), 'parent_id'=>$parent_id, 'order'=>''))?>">
			<img class="saveorder" src="<?=Conf::$site;?>/images/msave.png" />
		</a>
	</td>	
	<td class="aligncenter" width="30">
		<form action="<?=$this->url('menumanager', 'del', array('parent_id'=>$parent_id));?>" method="POST">
		<input type="hidden" value="<?=$this->chk($val, 'id')?>" name="id" />
		<input type="image" src="images/delete.png" class="confirm" title="Delete" />
		</form>
	</td>
  </tr>
<?php
}
?>
 </tbody>
</table>
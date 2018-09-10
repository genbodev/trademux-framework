<table class="datatable tablesorter" style="width:auto;">
<thead>
	<tr>
		<th>Login</th>
		<th width="150">Name</th>
		<th width="60">Role</th>
		<th width="150">Email</th>
		<th width="50">Active</th>
		<th width="150">Added on</th>
		<th width="150">Last login</th>
		<th width="20" sort="no">&nbsp;</th>
	</tr>
</thead>
<?php
foreach ($list as $item) 
{ 
?>
	<tr>
		<td>
			<a href="<?=$this->url('accessmanager', 'edit', array('id'=>$item["id"], 'type'=>$this->type));?>"><?=$item["login"];?></a>
		</td>
		<td><?=$item['name'];?></td>
		<td><?=$item['role'];?></td>
		<td><?=$item['email'];?></td>
		<td><?=$this->chk($item['active'], 1, '<img src="'.Conf::$site.'/images/active.png" alt="yes" title="yes" />');?></td>
		<td><?=$item['date_add'];?></td>
		<td><?=$item['date_last_login'];?></td>
		<td class="aligncenter">
			<form method="post" action="<?=$this->url('accessmanager', 'del', array('type'=>$this->type));?>" style="margin: 0; padding:0;">
			<input type="hidden" name="id" value="<?=$item["id"];?>">
			<input type="image" src="<?=Conf::$site;?>/images/delete.png" class="confirm" title="delete" alt="delete">
			</form>
		</td>
	</tr>
<?php
} 
?>
</table>
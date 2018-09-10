<table class="datatable tablesorter" style="width:auto;">
<thead>
	<tr>
		<th>Role</th>
		<th width="30" sort="no">&nbsp;</th>
	</tr>
</thead>
<tbody>
<?php
foreach ($list as $item) 
{ 
?>
	<tr>
		<td>
			<a href="<?=$this->url('accessmanager', 'edit', array('id'=>$item["id"], 'type'=>$this->type));?>"><?=$item["title"];?></a>
		</td>
		<td class="aligncenter">
			<form method="post" action="<?=$this->url('accessmanager', 'del', array('type'=>$this->type));?>" style="margin: 0; padding:0;">
			<input type="hidden" name="id" value="<?=$item["id"];?>">
			<input type="image" src="<?=Conf::$site;?>/images/delete.png" class="confirm" style="border: none;" title="delete">
			</form>
		</td>
	</tr>
<?php
}
?> 
</tbody>
</table>
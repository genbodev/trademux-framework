<h1>Articles List</h1>
<table class="datatable tablesorter">
 <thead>
  <tr>
	<th>Title</th>
	<th>Alias</th>
	<th>Category</th>
	<th width="140">Date Added</th>
	<th width="140">Last Modify</th>
	<th width="30" sort="no">
		<a href="<?=$this->url('articlesmanager', 'edit', array('id'=>'-1'))?>" class="clear">
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
		<a href="<?=$this->url('articlesmanager', 'edit', array('id'=>$this->chk($val, 'id')))?>">
		<?=$this->chk($val, 'title')?>
		</a>
	</td>
	<td>
		<?=$this->chk($val, 'alias')?>
	</td>
	<td>
		<?=$this->chk($val, 'category')?>
	</td>
	<td class="small">
		<?=$this->chk($val, 'created')?>
	</td>
	<td class="small">
		<?=$this->chk($val, 'modify')?>
	</td>
	<td class="aligncenter">
		<form action="<?=$this->url('articlesmanager', 'del')?>" method="POST">
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
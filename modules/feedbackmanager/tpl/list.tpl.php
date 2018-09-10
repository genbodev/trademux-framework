<h1>Requests List</h1>
<table class="datatable tablesorter">
 <thead>
  <tr>
	<th>Date Added</th>
	<th>Type</th>
	<th>Person</th>
	<th>Email</th>
	<th>Phone</th>
	<th>Skype</th>
	<th>Activity</th>
	<th>Company</th>
	<th>Site</th>
	<th>Preview</th>
	<th width="30" sort="no">
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
		<a href="<?=$this->url($this->_module, 'view', array('id'=>$this->chk($val, 'id')))?>">
		<?=$this->chk($val, 'created')?>
		</a>
	</td>
	<td>
		<?=$this->chk($val, 'type')?>
	</td>
	<td>
		<?=$this->chk($val, 'name')?>
	</td>
	<td>
		<?=$this->chk($val, 'email')?>
	</td>
	<td>
		<?=$this->chk($val, 'phone')?>
	</td>
	<td>
		<?=$this->chk($val, 'skype')?>
	</td>
	<td>
		<?=$this->chk($val, 'activity')?>
	</td>
	<td>
		<?=$this->chk($val, 'company')?>
	</td>
	<td>
		<?=$this->chk($val, 'site')?>
	</td>
	<td>
		<?=substr($this->chk($val, 'comment'), 0, 100)?>...
	</td>
	<td class="aligncenter">
		<form action="<?=$this->url($this->_module, 'del')?>" method="POST">
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
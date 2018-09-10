<h1>Edit Menu</h1>
<div class="aligncenter" style="color: #e00;"><?=$this->chk($message)?></div>
<form action="<?=$this->url('menumanager', 'save')?>" method="POST">
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="data[parent_id]" value="0" />
<input type="hidden" name="data[type]" value="menu" />
<table>
<tr>
	<td>Title:*</td>
	<td><input type="text" name="data[title]" value="<?=$this->chk($data, 'title')?>"/></td>
</tr>
<tr>
	<td>Description:</td>
	<td><textarea name="data[desc]"><?=$this->chk($data, 'desc')?></textarea></td>
</tr>
<tr>
	<td><input type="submit" value="Save" /></td>
	<td><a href="<?=$this->url('menumanager', '')?>" class="button">Back</a></td>
</tr>
</table>
</form>

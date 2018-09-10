<h1>Edit Category <?=$this->chk($data, 'title');?></h1>
<form method="POST" action="<?=$this->url('categoriesmanager', 'save') ?>" enctype="multipart/form-data">
<div class="message"><?=$this->chk($message)?></div>
<input type="hidden" name="id" value="<?=$id?>" />
<table>
	<tr>
		<td>Title: *</td>
		<td>
			<input type="text" name="data[title]" id="title" value="<?=$this->chk($data, 'title');?>" class="fullwidth" />
		</td>
	</tr>
	<tr>
		<td>Alias: *</td>
		<td>
			<input type="text" name="data[alias]" id="alias" value="<?=$this->chk($data, 'alias');?>" class="fullwidth" />
		</td>
	</tr>
	<tr>
		<td>Parent Category:</td>
		<td>
		<?=$this->drawSelect($categories, 'id', 'title', 'name="data[parent_id]" class="fullwidth"', '<option value="0"> </option>', $this->chk($data, 'parent_id'));?>
		</td>
	</tr>
	<tr>
		<td>Description:</td>
		<td>
			<textarea class="medium" name="data[description]"><?=$this->chk($data, 'description');?></textarea>
		</td>
	</tr>
	<tr>
		<td>Page title:</td>
		<td>
			<input type="text" name="data[page_title]" value="<?=$this->chk($data, 'page_title');?>" class="fullwidth" />
		</td>
	</tr>
	<tr>
		<td>Meta keywords:</td>
		<td>
			<textarea class="medium" name="data[meta_keywords]"><?=$this->chk($data, 'meta_keywords');?></textarea>
		</td>
	</tr>
	<tr>
		<td>Meta description:</td>
		<td>
			<textarea class="medium" name="data[meta_description]"><?=$this->chk($data, 'meta_description');?></textarea>
		</td>
	</tr>
	<tr>
		<td><input type="submit" value="Save" id="save" /></td>
		<td><a href="<?=$this->url('categoriesmanager', '')?>" class="button">Back</a></td>
	</tr>
</table>
</form>
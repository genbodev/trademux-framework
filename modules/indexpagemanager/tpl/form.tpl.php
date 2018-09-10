<h1>Edit Main Page</h1>
<div class="message"><?=$this->chk($message)?></div>
<form action="<?=$this->url($this->_module, 'save')?>" method="POST">
<input type="hidden" name="page" value="<?=$page?>" />
<table>
	<tr>
		<td>Title:</td>
		<td><input type="text" id="title" name="data[title]" value="<?=$this->chk($data, 'title')?>"/></td>
	</tr>
	<tr>
		<td>Content:</td>
		<td><?=$this->getCKEditor('data[content]', $this->chk($data, 'content'));?></td> 
	</tr>
	<tr>
		<td>Page title:</td>
		<td><input type="text" name="data[page_title]" value="<?=$this->chk($data, 'page_title');?>" class="fullwidth" /></td>
	</tr>
	<tr>
		<td>Meta keywords:</td>
		<td><textarea class="medium" name="data[meta_keywords]"><?=$this->chk($data, 'meta_keywords');?></textarea></td>
	</tr>
	<tr>
		<td>Meta description:</td>
		<td><textarea class="medium" name="data[meta_description]"><?=$this->chk($data, 'meta_description');?></textarea></td>
	</tr>
	<tr>
		<td><input type="submit" value="Save" id="save" /></td>
		<td><a href="<?=$this->url($this->_module, '')?>" class="button">Back</a></td>
	</tr>
</table>
</form>
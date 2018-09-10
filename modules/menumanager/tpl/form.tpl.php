<h1>Edit</h1>
<div class="aligncenter" style="color: #e00;"><?=$this->chk($message)?></div>
<form action="<?=$this->url('menumanager', 'save')?>" method="POST" id="postform">
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="data[parent_id]" value="<?=$this->chk($parent_id)?>" />
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
	<td valign="top">
		<label>
			<input type="radio" name="data[type]" class="typeselect" value="category" <?=$this->chk($data['type'], 'category', 'checked="checked"');?>/> 
			Category 
		</label><br />
		<label>
			<input type="radio" name="data[type]" class="typeselect" value="article" <?=$this->chk($data['type'], 'article', 'checked="checked"');?>/> 
			Article 
		</label><br />
		<label>
			<input type="radio" name="data[type]" class="typeselect" value="link" <?=$this->chk($data['type'], 'link', 'checked="checked"');?>/> 
			Link 
		</label><br />
		<label>
			<input type="radio" name="data[type]" class="typeselect" value="none" <?=$this->chk($data['type'], 'none', 'checked="checked"');?>/> 
			None 
		</label><br />
	</td>
	<td valign="top">
		<table id="category" style="display:none;<?=$this->chk($data['type'], 'category', 'display:table;');?>" class="type">
			<tr>
				<td>Category:</td>
				<td>
				<?=$this->drawSelect($categories, 'alias', 'title', 'name="data[category]" class="fullwidth"', 
									 '<option value=""> </option>', $this->chk($data, 'alias'));?>
				</td>
			</tr>
		</table>
		<table id="article" style="display:none;<?=$this->chk($data['type'], 'article', 'display:table;');?>" class="type">
			<tr>
				<td>Category:</td>
				<td>
				<?=$this->drawSelect($categories, 'id', 'title', 'name="data[artcat_id]" id="forarticles" class="fullwidth"', 
									 '<option value=""> </option>', $this->chk($data, 'cat_id'));?>
				</td>
			</tr>
			<tr>
				<td>Article:</td>
				<td>
				<?=$this->drawSelect($articles, 'alias', 'title', 'name="data[article]" id="articleslist" class="fullwidth"', 
									 '<option value=""> </option>', $this->chk($data, 'alias'));?>
				</td>
			</tr>
		</table>
		<table id="link" style="display:none;<?=$this->chk($data['type'], 'link', 'display:table;');?>" class="type">
			<tr>
				<td>Link:</td>
				<td>
					<input type="text" name="data[link]" value="<?=$this->chk($data, 'link')?>"/>
				</td>
			</tr>
		</table>
	</td>
	<td valign="top" id="checkmessage" style="padding: 0 0 0 35px;">
	</td>
</tr>
<tr>
	<td><input type="submit" value="Save" /></td>
	<td><a href="<?=$this->url('menumanager', 'index', array('parent_id'=>$parent_id))?>" class="button">Back</a></td>
</tr>
</table>
</form>
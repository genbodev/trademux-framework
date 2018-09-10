<h1>View request</h1>
<div class="message"><?=$this->chk($message)?></div>
<input type="hidden" name="id" value="<?=$id?>" />
<table width="100%">
	<tr>
		<td style="width: 150px;">ФИО:</td>
		<td><input type="text" name="data[name]" value="<?=$this->chk($data, 'name');?>" readonly="readonly" /></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><input type="text" name="data[email]" value="<?=$this->chk($data, 'email');?>" readonly="readonly" /></td>
	</tr>
	<tr>
		<td>Тел.:</td>
		<td><input type="text" name="data[phone]" value="<?=$this->chk($data, 'phone');?>" readonly="readonly" /></td> 
	</tr>
	<tr>
		<td>Skype:</td>
		<td><input type="text" name="data[skype]" value="<?=$this->chk($data, 'skype');?>" readonly="readonly" /></td>
	</tr>
	<tr>
		<td>Сфера деятельности:</td>
		<td><input type="text" name="data[activity]" value="<?=$this->chk($data, 'activity');?>" readonly="readonly" /></td>
	</tr>
	<tr>
		<td>Компания:</td>
		<td><input type="text" name="data[company]" value="<?=$this->chk($data, 'company');?>" readonly="readonly" /></td>
	</tr>
	<tr>
		<td>Сайт:</td>
		<td><input type="text" name="data[site]" value="<?=$this->chk($data, 'site');?>" readonly="readonly" /></td>
	</tr>
	<tr>
		<td>Текст:</td>
		<td><textarea class="medium" name="data[comment]" readonly="readonly" style="width: 100%; height: 300px;"><?=$this->chk($data, 'comment');?></textarea></td>
	</tr>
	<tr>
		<td><a href="<?=$this->url($this->_module, '')?>" class="button">Back</a></td>
	</tr>
</table>

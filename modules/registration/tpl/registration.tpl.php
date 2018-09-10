<?=$this->_includeThisToTpl('notes', 'form');?>
<h3>Please fill the form below:</h3>
<div class="message"><?=$this->chk($message)?></div>
<form method="post" action="<?=$this->url('registration', 'register')?>" id="saveform">
<input type="hidden" name="data[code]" value="<?=$this->chk($data, 'code')?>" />
<table>
<tr>
	<td>Your email address: </td>
	<td colspan="3">
		<?=$this->chk($data, 'email')?>
	</td>
</tr>
<tr>
	<td width="135">Choose password:</td>
	<td>
		<input type="password" name="data[pass]" class="rcpass rccpass" value="<?=$this->chk($data, 'pass')?>" />
		<span id="erpass" class="error" style="margin-left:10px; display:none;">Password should be 6-32 latin characters and digits</span>
	</td>
	<td width="125" style="padding-left: 45px">Repeat Password:</td>
	<td>
		<input type="password" name="data[repass]" class="rccpass" value="<?=$this->chk($data, 'repass')?>" />
		<span id="errepass" class="error" style="margin-left:10px; display:none;">Confirm password</span>
	</td>
</tr>
<tr>
	<td>Select your country:</td>
	<td colspan="3">
		<?=$this->drawSelect($countries, 'id', 'name', 'name="data[country]"', true);?>
		<span id="errepass" class="error" style="margin-left:10px; display:none;">Select country</span>
	</td>
</tr>
<tr>
	<td>Select your account type:</td>
	<td colspan="3">
		<?=$this->drawRadio($acctypes, null, null, 'name="data[acc_type]"')?>
		<div id="trust" style="margin-left: 25px; display: none;">
			<?=$this->drawRadio($trusttypes, null, null, 'name="data[trust_type]"')?>
		</div>
	</td>
</tr>
<tr id="company_row" style="display: none;">
	<td>Company name:</td>
	<td colspan="3">
		<input type="text" name="data[company]" value="<?=$this->chk($data, 'company')?>" />
		<span id="errepass" class="error" style="margin-left:10px; display:none;">Confirm password</span>
	</td>
</tr>
<tr>
	<td>First name:</td>
	<td><input type="text" name="data[name]" class="rctext" value="<?=$this->chk($data, 'name')?>" /></td>
	<td style="padding-left: 45px">Last name:</td>
	<td><input type="text" name="data[lastname]" class="rctext" value="<?=$this->chk($data, 'lastname')?>" /></td>
</tr>
<tr>
	<td>Date of birth:</td>
	<td colspan="3">
	<?php
	$days = array();
	for ($i = 1; $i<=31; $i++) $days[$i] = $i;
	$monthes = array();
	for ($i = 1; $i<=12; $i++) $monthes[$i] = $i;
	$years = array();
	$dt = new DateTime();
	$dt->modify("-17 years");
	$y = $dt->format('Y');
	for ($i = 1920; $i<=$y; $i++) $years[$i] = $i;
	?>
	<?=$this->drawSelect($days, null, null, 'name="data[dobd]" style="width: 50px"', true);?>
	<?=$this->drawSelect($monthes, null, null, 'name="data[dobm]" style="width: 50px"', true);?>
	<?=$this->drawSelect($years, null, null, 'name="data[doby]" style="width: 70px"', true);?>
	</td>
</tr>
<tr>
	<td colspan="4" align="center"><input type="submit" class="button btn btn-primary" style="margin-top: 25px;" value="Open account"></td>
</tr>
</table>
</form>

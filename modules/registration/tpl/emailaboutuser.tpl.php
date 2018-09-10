<b>Name:</b> <?=$this->chk($data, 'name');?> <?=$this->chk($data, 'lastname');?><br />
<b>Email:</b> <?=$this->chk($data, 'email');?><br />
<b>Account Type:</b> <?=$this->chk($acctypes, $this->chk($data, 'acc_type'));?><br />
<?  if ($this->chk($data, 'acc_type') == 't') 
		echo '<b>Trust Type:</b> '.$this->chk($trusttypes, $this->chk($data, 'trust_type')).'<br />';
	else if ($this->chk($data, 'acc_type') == 'c')
		echo '<b>Company:</b> '.$this->chk($data, 'company').'<br />';
?>


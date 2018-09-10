<?php if ($error) echo '<div class="message">Please fill all mandatory fields</div>'; ?>
<form action="<?=$this->url($this->_module, 'send')?>" method="POST" id="requestform">
<input type="hidden" name="data[type]" id="requestformtype" value="request" />
Name <span class="required">*</span>:<br/>
<input type="text" name="data[name]" class="rctext" value="<?=$this->chk($data, 'name');?>" /><br />
Email <span class="required">*</span>:<br/>
<input type="text" name="data[email]" class="rcemail" value="<?=$this->chk($data, 'email');?>" /><br />
Skype:<br />
<input type="text" name="data[skype]" value="<?=$this->chk($data, 'skype');?>" /><br />
Text <span class="required">*</span>:<br />
<textarea class="medium" name="data[comment]" style="width: 98%; height: 160px" class="rctext"><?=$this->chk($data, 'comment');?></textarea><br />
<i>Fields market by <span class="required">*</span> are mandatory</i><br />
<input type="button" id="requestsendbtn" class="button btn btn-primary" value="Send" />
</form>

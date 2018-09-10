Hello <?=$name?>,<br /><br />
A request has been made to reset your <?=Conf::$sitename;?> account password.<br /><br />
To reset your password follow the link below : <br />
<a href="<?=$this->url('registration','changepass', array('code'=>$code));?>"><?=$this->url('registration','changepass', array('code'=>$code));?></a>
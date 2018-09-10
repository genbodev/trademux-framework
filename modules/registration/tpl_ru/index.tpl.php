<?=$this->_includeThisToTpl('notes', 'form');?>
<div class="message"><?=$this->chk($message)?></div>
<div>
<div style="float: left; margin: 5px 10px; font-weight: bold;">Введите свой Email: </div>
<div class="input-prepend">
<span class="add-on"><i class="icon-envelope"></i></span>
<input type="text" class="focused" id="email"  />
</div>
<input id="submit" type="button" class="button btn btn-primary" value="Открыть счет" style="margin: -6px 10px 0 10px; padding: 7px 14px;" />
</div>
<div id="notify" class="notification"></div>
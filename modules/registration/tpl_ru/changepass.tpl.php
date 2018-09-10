<nav class="wrap t3-navhelper">
	<div class="container">
		<div class="row">
			<div class="span12">
    			<ul class="breadcrumb ">
					<li class="active">Вы здесь: &nbsp;</li>
					<li><a class="pathway" href="/">Главная</a></li>
					<li><span class="divider">/</span><span>Восстановление пароля</span></li>
				</ul>
			</div>
		</div>
	</div>
</nav>
<section id="t3-mainbody" class="t3-mainbody main-left wrap">
  <div class="container">
	  <div class="row">
		<div id="t3-content" class="t3-content span9">
			<div class="main-content">
				<div id="system-message-container"> </div>
				<div class="t3-component" style="padding: 30px 0 30px 15px">
					<div class="item-page clearfix">
						<article>
							<header class="article-header clearfix"><h1 class="article-title">Восстановление пароля</h1></header>
							<section class="article-content clearfix trader">
<form method="post" action="<?=$this->url('registration', 'setpass')?>" id="saveform">
<input type="hidden" name="code" value="<?=$this->chk($data,'code')?>">
<table>
<tr>
	<td width="130">E-mail</td>
	<td><?=$this->chk($data, 'email')?></td>
</tr>
<tr>
	<td>Новый пароль *</td>
	<td>
	<input type="password" name="pass"  class="rcpass rccpass">
	<span id="erpass" class="error" style="margin-left:10px; display:none;">Password should be 6-32 latin characters and digits</span>
	</td>
</tr>
<tr>
	<td>Повтор пароля *</td>
	<td>
	<input type="password" name="repass" class="rccpass">
	<span id="errepass" class="error" style="margin-left:10px; display:none;">Confirm password</span>
	</td>
</tr>

<tr>
<td></td>
<td align="left">
<input type="submit" class="button btn btn-primary" value="Изменить пароль">
</tr>
</table>
</form>
<script src="<?=Conf::$site?>/modules/registration/js/forgotpass.js"></script>
							</section>
						</article>
					</div>
				</div>
			</div>
		</div>

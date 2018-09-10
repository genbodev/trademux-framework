<section id="t3-mainbody" class="t3-mainbody main-left wrap">
  <div class="container">
	  <div class="row">
		<div id="t3-content" class="t3-content span9">
			<div class="main-content">
				<div id="system-message-container"> </div>
				<div class="t3-component" style="padding: 30px 0 30px 15px">
					<div class="item-page clearfix">
						<article>
							<section class="article-content clearfix trader">
								<div class="message"><?=$this->chk($message);?></div>
								<form action="<?php echo $uri; ?>" method="POST">
								<input type="hidden" name="step" value="2" />
								<table cellpadding="3" cellspacing="0" border="0" class="centered">
								<tr><td class="alignright">Email&nbsp;:&nbsp;</td><td><input type="text" name="login"/></td></tr>
								<tr><td class="alignright">Пароль&nbsp;:&nbsp;</td><td><input type="password" name="pass"/></td></tr>
								<tr><td colspan="2" class="aligncenter"><input type="submit" class="btn btn-primary" value="Войти" /></td></tr>
								</table>
								</form>
								<ul>
					    			<li><a href="<?=$this->url('registration','forgotpass')?>">Восстановить пароль</a></li>
					    			<li><a href="<?=$this->url('registration')?>">Открыть счет</a></li>
					    	  	</ul>
							</section>
						</article>
					</div>
				</div>
			</div>
		</div>
	  </div>
  </div>
</section>
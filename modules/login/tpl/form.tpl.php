<div id="rt-breadcrumbs">
	<div class="rt-container">
		<div class="rt-grid-12 rt-alpha rt-omega">
			<div class="rt-block">
				<div class="rt-block1">
					<div class="module-content">
						<div class="breadcrumbs">
							<a class="pathway" href="/">Home</a>
							<a class="pathway">Authentication Required</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div id="rt-main" class="mb12">
	<div class="rt-container">
		<div class="rt-grid-12 ">
			<div class="rt-block">
				<div id="rt-mainbody">
					<div id="rt-mainbody">
						<div class="component-content">
							<div class="rt-article">
								<div class="rt-article-box1">
									<div class="item-page">
										<h2 class="title">Authentication Required</h2>
										<div class="rt-article-content">
								<div class="message"><?=$this->chk($message);?></div>
								<form action="<?php echo $uri; ?>" method="POST">
								<input type="hidden" name="step" value="2" />
								<table cellpadding="3" cellspacing="0" border="0" class="centered">
								<tr><td class="alignright">Email&nbsp;:&nbsp;</td><td><input type="text" name="login"/></td></tr>
								<tr><td class="alignright">Password&nbsp;:&nbsp;</td><td><input type="password" name="pass"/></td></tr>
								<tr><td colspan="2" class="aligncenter"><input type="submit" class="button" value="Log in" /></td></tr>
								</table>
								</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
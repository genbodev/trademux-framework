<nav class="wrap t3-navhelper">
	<div class="container">
		<div class="row">
			<div class="span12">
    			<ul class="breadcrumb ">
					<li class="active">You are here: &nbsp;</li>
					<li><a class="pathway" href="/">Home</a></li>
					<li><span class="divider">/</span><span>Password Recovery</span></li>
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
							<header class="article-header clearfix"><h1 class="article-title">Password Recovery</h1></header>
							<section class="article-content clearfix trader">
								<div class="message"><?=$this->chk($message)?></div>
								<form method="post" action="<?=$this->url('registration', 'forgotsend')?>" id="saveform">
									<div style="float: left; margin: 5px 10px;">Input your Email address: </div>
									<input type="text" name="email" class="rcemail" /> 
									<input type="submit" value="Send" class="button btn btn-primary" style="margin: -12px 10px 0 10px;"/>
									<span id="eremail" class="error" style="margin-left:10px; display:none;">Please enter valid email</span>
								</form>
							</section>
						</article>
					</div>
				</div>
			</div>
		</div>
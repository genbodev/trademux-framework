<nav class="wrap t3-navhelper">
	<div class="container">
		<div class="row">
			<div class="span12">
    			<ul class="breadcrumb ">
					<li class="active">You are here: &nbsp;</li>
					<li><a class="pathway" href="/">Home</a></li>
					<li><span class="divider">/</span><span>Search</span></li>
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
							<header class="article-header clearfix"><h1 class="article-title">Search results</h1></header>
							<section class="article-content clearfix trader">
								<?php 
								foreach($list as $val)
								{
									$link = Conf::$site.'/'.$val['alias'].'.html';
									?>
									<h3><a href="<?=$link?>"><?=$val['title']?></a></h3>
									<div><?=$val['preview']?></div>
									<?php
								}
								?>
							</section>
						</article>
					</div>
				</div>
			</div>
		</div>

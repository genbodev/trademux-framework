<?=$this->_includeThisToTpl('rightblock', 'body');?>
<nav class="wrap t3-navhelper">
	<div class="container">
		<div class="row">
			<div class="span12">
    			<ul class="breadcrumb ">
					<li class="active">Вы здесь: &nbsp;</li>
					<li><a class="pathway" href="/">Главная</a></li>
					<?
						if (is_array($breadcrumbs)) foreach ($breadcrumbs as $item) echo '<li><span class="divider">/</span><span>'.$item.'</span></li>';
					?>
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
				<div class="t3-component">
					<div class="item-page clearfix">
						<article>
							<header class="article-header clearfix"><h1 class="article-title"><a href=""><?=$this->chk($h1title);?></a></h1></header>
							<section class="article-content clearfix">
								<?=$body;?>
							</section>
						</article>
					</div>
				</div>
			</div>
		</div>

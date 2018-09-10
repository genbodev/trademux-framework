<?=$this->_includeThisToTpl('main', 'body');?>
<div id="rt-breadcrumbs">
	<div class="rt-container">
		<div class="rt-grid-12 rt-alpha rt-omega">
			<div class="rt-block">
				<div class="rt-block1">
					<div class="module-content">
						<div class="breadcrumbs">
							<a class="pathway" href="/">Home</a>
							<?
							if (is_array($breadcrumbs)) foreach ($breadcrumbs as $item) echo '<a class="pathway">'.$item.'</a>';
							?>
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
										<?=$body;?>
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

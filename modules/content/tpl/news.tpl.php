<h1>News</h1>
<?php
if (!empty($subcategories))
{
	?>
	<div class="subcats">
	<?php 
		foreach ($subcategories as $val)
		{
			echo '<a href="'.$this->url('content', 'category', array('alias'=>$val['alias'])).'"><h2>'.$val['title'].'</h2></a>';
			echo '<div class="description">'.$val['description'].'</div>';
		}
	?>
	</div>
	<?php
}

foreach ($data['articles'] as $val)
{
	?>
	<div class="news">
		<div class="newsdate"><?=$val['date']?></div>
		<h2><a href="<?=$this->url('content', 'article', array('alias'=>$val['alias']))?>"><?=$val['title']?></a></h2>
		<?=$val['preview']?>
		<div class="newsreadmore">
			<a href="<?=$this->url('content', 'article', array('alias'=>$val['alias']))?>" class="readmore">Read more</a>
		</div>
		<div style="clear:both;"></div>
	</div>
	<?php
}
?>
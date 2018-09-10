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
?>
<?php
foreach ($data['articles'] as $val)
{
?>
<h2 class="title"><a href="<?=$this->url('content', 'article', array('alias'=>$val['alias']))?>"><?=$val['title']?></a></h2>
<div style="margin-bottom: 40px;">
<?=$val['preview']?><br />
<a href="<?=$this->url('content', 'article', array('alias'=>$val['alias']))?>" class="catreadmore button-small">Read more</a>
<div class="clear">&nbsp;</div>
</div>

<?php
}
?>
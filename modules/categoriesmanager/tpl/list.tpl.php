<h1>Categories List</h1>
<div class="message" style="<?php if (!$this->chk($message)) echo "display: none;"; ?>"><?=$this->chk($message)?></div>
<table class="datatable tablesorter">
	<tr>
		<th>Category</th>
		<th>
			<a href="<?=$this->url('categoriesmanager', 'edit', array('id'=>'-1'))?>">
				<img src="/images/add.png" title="Add" alt="Add"/>
			</a>
		</th>
	</tr>
	<?php 
	foreach ($categories as $cat) 
	{
		?>
		<tr>
			<td style="text-align: left;">
				<a href="<?=$this->url('categoriesmanager', 'edit', array('id'=>$cat['id']))?>" >
					<?=$cat['title']?> 
				</a>
			</td>
			<td>
				<a href="<?=$this->url('categoriesmanager', 'delete', array('id'=>$cat['id']))?>" class="confirm">
					<img src="/images/delete.png" title="Delete"/>
				</a>
			</td>
		</tr>
		<?php
	} 
	?>
</table>

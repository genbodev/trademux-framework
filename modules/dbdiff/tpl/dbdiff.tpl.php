<table>
	<tr valign="top">
		<th width="150" align="left">Create dump<br /><br /></th>
		<th align="left">Create SQL</th>
	</tr>
	<tr valign="top">
		<td>
			<form action="<?=$this->url('dbdiff', 'dump');?>" method="post" enctype="multipart/form-data">
				<input type="submit" value="Get Dump" name="dump">
			</form>
		</td>
		<td>
			<form action="<?=$this->url('dbdiff', 'diff');?>" method="post" enctype="multipart/form-data">
			<input type="file" name="attachment">
			<input type="submit" value="Get Script" name="up_file">
			</form>
		</td>
	</tr>
</table>
<br />
<div>
<?=$this->chk($script);?>
</div>
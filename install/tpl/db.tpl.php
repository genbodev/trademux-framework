<script>
function popupSubmit(form)
{
	$.ajax({
		type: form.method,
		url: form.action,
		data: $(form).serialize(),
		dataType: 'json',
		success: function(data)
		{
			if (data.errors.length == 0)
			{
				document.location.href = 'index.php?t=config';
			}
			else 
			{
				for (i = 0; i < data.errors.length; i++) alert(data.errors[i]);
			}
		}
	});
	return false;
}
</script>
<h1>MySQL DB settings</h1>
<div class="admin-inner">
<form method="post" action="index.php?t=dbsave" onsubmit="return popupSubmit(this)">
<table>
<tr>
	<td width="170">Host</td>
	<td><input type="text" name="dbhost"></td>
</tr>
<tr>
	<td>User</td>
	<td><input type="text" name="dbuser"></td>
</tr>
<tr>
	<td>Password</td>
	<td><input type="password" name="dbpass"></td>
</tr>
<tr>
	<td>Database Name</td>
	<td><input type="text" name="dbname"></td>
</tr>
</table>
</div>
<br>
<input type="submit" value="Next">
</form>
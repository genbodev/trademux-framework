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
				document.location.href = 'index.php?t=done';
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
<div class="admin-inner">
<h1>Site settings</h1>
<form method="post" action="index.php?t=configsave" onsubmit="return popupSubmit(this)">
<table>
<tr>
	<td width="170">Site Name</td>
	<td><input type="text" name="sitename" size="50" value="<?=$sitename?>"></td>
</tr>
<tr>
	<td>Site URL</td>
	<td><input type="text" name="site" size="50" value="<?=$site?>"></td>
</tr>
<tr>
	<td>Site Base Dir</td>
	<td><input type="text" name="document_root" size="50" value="<?=$document_root?>"></td>
</tr>
</table>
</div>
<br />
<br />
<div class="admin-inner">
<h1>Admin settings</h1>
<form method="post" action="index.php?t=configsave" onsubmit="return popupSubmit(this)">
<table>
<tr>
	<td width="170">Login</td>
	<td><input type="text" name="login" value="admin"></td>
</tr>
<tr>
	<td>Email</td>
	<td><input type="text" name="email" value="admin@admin.com"></td>
</tr>
<tr>
	<td>Password</td>
	<td><input type="password" name="pass"></td>
</tr>
<tr>
	<td>Confirm Password</td>
	<td><input type="password" name="repass"></td>
</tr>
</table>
</div>

<br>
<input type="submit" value="Next">
</form>
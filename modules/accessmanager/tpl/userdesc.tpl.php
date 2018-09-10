<h1>Edit user profile</h1>
<table>
<tr><td>Login: </td><td><input type="text" name="data[desc][title]" value="<?=$title; ?>" /></td></tr>
<tr><td>Name: </td><td><input type="text" name="data[desc][name]" value="<?=$name; ?>" /></td></tr>
<tr><td>E-mail: </td><td><input type="text" name="data[desc][email]" value="<?=$email; ?>" /></td></tr>
<tr><td>Role: </td><td><?=$roleselect; ?></td></tr>
<tr><td>Password: </td><td><input type="text" name="data[desc][pass]" value="" /></td></tr>
<tr><td>Active: </td><td><input type="checkbox" name="data[desc][active]" value="1" <?=$this->chk($active,1,'checked="checked"'); ?>/></td></tr>
<tr><td>Added: </td><td><?=$date_add; ?></td></tr>
<tr><td>Updated: </td><td><?=$date_last_modify; ?></td></tr>
<tr><td>Last log in: </td><td><?=$date_last_login; ?></td></tr>
</table>
$(function()
{
	$('input[type=checkbox].selectall').click(function()
	{
		checked = ($(this).attr('checked'));
		order = ($(this).parent().attr('cellIndex'));
		
		$('table.accessmap tr').find('td:eq('+order+') input[type=checkbox]').attr('checked', checked);
	});
});
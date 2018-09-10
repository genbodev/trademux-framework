$(function()
{
	$('input.typeselect').click( function () 
	{
		var id = $(this).val();
		$('table.type').css('display', 'none');
		$('table#'+id).css('display', 'table');
	});
	
	$('select#forarticles').change( function ()
	{
		var cat = $(this).val();
		$(this).attr('disabled', true);
		$.get(siteurl+'/index.php?m=menumanager&t=articleslist&ajax=html&'+langurl+'&cat='+cat, [], function(data, status) 
		{
			if (data) $('select#articleslist').html(data);
			$('select#forarticles').attr('disabled', false);
		});
	});
	
	$('select[name="data[category]"], select[name="data[article]"], input[name="data[link]"], textarea').change( function()
	{
		$.post(siteurl+'/index.php?m=menumanager&t=save&check=1&ajax=json&'+langurl, $('form#postform').serialize(), function(data, status) 
		{
			if (data && data.items.length > 0)
			{
				var s = '<b>Menu items with same link:</b><br/>'+String(data.items).replace(/,/g,'<br /> ');
				$('td#checkmessage').html(s);
			}
			else $('td#checkmessage').html('');
		}
		, 'json');
	});
	
	$('.typeselect').change( function()
	{
		$('td#checkmessage').html('');
	});
});
$(function()
{	
	$('.sqlquery').click(function()
	{
		if (confirm('Are you sure?'))
		{
			var query = this.innerHTML;
			var link = this;
			$.ajax({
				url: 'index.php?m=dbdiff&t=execSQL&ajax=json',
				type: 'POST',
				data: 'sql='+encodeURIComponent(query),
				dataType: 'json',
				success: function (data)
				{
					if (data.success)
					{
						$(link).before('<span class="execsql">'+query+'</span>').remove();
					}
				}
			});
		}
	});
});
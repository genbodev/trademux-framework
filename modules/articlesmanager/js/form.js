$(function()
{
	$('input#title').change( function ()
	{
        value = $(this).val().replace(/[^A-Za-z0-9]+/g, '_').toLowerCase();
    	$('input#alias').val(value);
	});

	$('#save').click(function(event)
	{
		var err = false;
		$('#title, #alias').each(function()
		{
			if($.trim(this.value) == '') err = true;
		});
		
		if (err) 
		{
			alert("Please, fill all necessary fields");
			event.preventDefault();
			return false;
		}
		else 
		{
			var unique = false;
			var id = $('input[name="id"]').val();
			var alias = $('input#alias').val();
			$.ajax({async:false, url:siteurl+'/index.php?m=articlesmanager&t=check&ajax=json&'+langurl, type:'POST', data:{'id':id, 'alias':alias}, 
					dataType:'json', success:function(data, textStatus, XMLHttpRequest)
			{
				unique = data.unique;
			}});
			
			if (!unique) 
			{
				alert("Not unique alias. Please, choose another");
				event.preventDefault();
				return false;
			}
		}
	});
});
function show_ajaxloader(obj)
{
        jQuery(obj).append('<img src="images/ajaxloader.gif" class="loader" alt="Loading ..." title="Loading ..." />');
}

function hide_ajaxloader(obj)
{
        jQuery(obj).find('img.loader').remove();
}

jQuery(function()
{
    jQuery('.confirm').click(function()
	{
		if (!confirm('Are you sure?')) return false;
	});
	
	jQuery(document).ajaxError(function(event, request, settings)
	{
		alert("Ajax error url: "+settings.url+"\nResponse:\n"+request.responseText);
	});
	
	var reqblock = jQuery("#feedbackformblock");
	if (reqblock.length > 0)
	{
		reqblock.html('<img src="/images/ajaxloader.gif" alt="Loading ..." />');
		jQuery.get(base_url+"/feedback.shtml?ajax=html", {}, function (data) 
		{
			reqblock.html(data);
			var type = reqblock.attr('type');
			reqblock.find("#requestformtype").val(type);
			reqblock.find("#requestsendbtn").click(function () 
			{
				jQuery(this).attr('disabled','disabled');
				jQuery(this).after('<img src="/images/ajaxloader.gif" alt="Loading ..." />');
				var reqdata = reqblock.find("#requestform").serialize();
				jQuery.post(base_url+"/feedback/send.shtml?ajax=html", reqdata, function (result) 
				{
					reqblock.html(result);
				});
			});
		});
	}
});
jQuery(function() 
{
	jQuery('#submit').click( function (event) 
	{
		jQuery('#notify').html('');
		var value = jQuery('#email').val();
	
		reg=/^[\d\w-_\.]+@[\d\w-_\.]+$/;
		
    	if (reg.test(value.toLowerCase()))
    	{
    		jQuery('#submit').attr("disabled","disabled");
    		show_ajaxloader(jQuery('#submit').parent());
    		jQuery.post(base_url+"/registration/email.shtml?ajax=json", {email: value}, function(result)
    		{
    			jQuery('#notify').html(result.message);
    			jQuery('#submit').removeAttr("disabled");
    			hide_ajaxloader(jQuery('#submit').parent());
    		}, 'json');
    	}
		else jQuery('#notify').html('Please enter valid email');

	});
});
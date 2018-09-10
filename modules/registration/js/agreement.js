jQuery(function()
{
	jQuery('form#saveform').submit( function (event)
	{
		var data = jQuery.trim(jQuery('input[name="sign"]').val());

		if (data == "")
		{
			jQuery("div.message").html("Please type your name");
			event.preventDefault();
			return false;
		}
	});
});
$(function() 
{
	$('form#saveform').submit( function (event) 
	{
		var ok = Check.checkForm(this);
		
		if (!ok)
		{
			event.preventDefault();
			return false;
		}
	});
});
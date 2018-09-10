jQuery(function() 
{
	jQuery('input[name="data[acc_type]"]').click(function() 
	{
		if (jQuery(this).val() == 't') jQuery('#trust').css('display','');
		else jQuery('#trust').css('display','none');
		if (jQuery(this).val() == 'c') jQuery('#company_row').css('display','');
		else jQuery('#company_row').css('display','none');
	});
});
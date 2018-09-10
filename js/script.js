datepickersettings = {changeMonth: true, changeYear: true, yearRange: 'c-10:c+10', autoSize: true};

$(function()
{
    $('.confirm').click(function()
	{
		if (!confirm('Are you sure?')) return false;
	});
	
	// -- tablesorter --
  	$('table.tablesorter').tablesorter(
  	{
  		textExtraction: "replace",
  		replaceSymbol: "$"
	});
	
	$('.tablefiltertoggle').toggle(function()
	{
		var selector = $(this).attr('for');
		var filtered = $(this).attr('filtered');
		if (filtered) $(selector).find('thead').find('tr').last().show();
		else $(selector).tableFilter();
	}, function() 
	{
		var selector = $(this).attr('for');
		$(selector).find('thead').find('tr').last().hide();
		$(this).attr('filtered', '1');
	});
	
	$(document).ajaxError(function(event, request, settings)
	{
		alert("Ajax error url: "+settings.url+"\nResponse:\n"+request.responseText);
	});
	
	//$('form.validate').FormValidate({ajax:false, validCheck: false, error_msg:'Please fill all required fields'});
	
	//$('.datepicker').datepicker(datepickersettings);
	
	// -- tabs --
	$('.tab_mark').click(function()
	{
		var pan_id = $(this).attr('tab');
		$('.tab_panel').hide();
		$('#'+pan_id).show();
		$('.tab_mark').removeClass('tab_active');
		$(this).addClass('tab_active');
	});
	$('.tab_panel').hide();
	$('.tab_panel:first').show();
	
	// -- checkboxes bind to input hidden --
	$('input[bind]').click(function()
	{
		if ($(this).attr('checked')) $('input[name="'+$(this).attr('bind')+'"]').val('1');
		else $('input[name="'+$(this).attr('bind')+'"]').val('0');
	});
	
	$('.changeorder').change(function () 
	{
		$(this).parent().find('a.saveorder').css('display', 'inline');
	});
	
	$('img.saveorder').click(function () 
	{
		var order = $(this).parent().parent().find('input').val();
		var href = $(this).parent().attr('href');
		$(this).parent().attr('href', href+order);
	});
	
	// -- show message --//
	showXMessage();
});

function showXMessage()
{
	var div = $('#xmsg-div');
	if (div.html() != '' && div.css('display') == 'none')
	{
		div.show();
	    setTimeout("showXMessage()", 3000);
	}
	else div.hide();
}

function show_ajaxloader(obj)
{
        $(obj).append('<img src="images/ajaxloader.gif" class="loader" alt="Loading ..." title="Loading ..." />');
}

function hide_ajaxloader(obj)
{
        $(obj).find('img.loader').remove();
}
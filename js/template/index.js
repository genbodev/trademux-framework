//<![CDATA[
		try {$Gavick;}catch(e){$Gavick = {};};
		$Gavick["gktab-gkTab-268"] = {
			"activator" : "click",
			"animation" : 1,
			"animation_speed" : 180,
			"animation_interval" : 8000,
			"animation_type" : "slider",
			"animation_function" : Fx.Transitions.Expo.easeInOut,
			"active_tab" : 1,
			"cookie_save" : 0
		};
		//]]>

	$(document).ready(function(){
	$('#slider ul').cycle({
		
		'prev': 		$('#prev'),
		'next': 		$('#next'),
		'fx': 			'fade', 
		'timeout': 		5000,
		'speed': 		1500
	});
	
});

$(document).ready(function() {
	$.ajax({
		type: 'POST',
		url: '/getbestellingbyuser',
		data: data,
		dataType: 'json',
		success: function(jsonData) {
			  		
		}
    });
});
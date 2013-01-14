$(document).ready(function() {
    $('#timedate').datetimepicker();
    $("#order").click(function() {
	    	alert("Gelieve eerst in te loggen.");
	});
	
	var user_input1 = document.getElementById('address1');
	var user_input2 = document.getElementById('address2');
	var options = {
		 types: ['geocode']
		 };
	
	userAutocomplete = new google.maps.places.Autocomplete(user_input1, options);
	userAutocomplete = new google.maps.places.Autocomplete(user_input2, options);
	
	$("#help").click(function() {
      $("#loginhelp").reveal();
    });
   
    $('#verder').trigger('reveal:close');
});
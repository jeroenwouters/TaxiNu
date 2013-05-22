$(document).ready(function() {
    
    var now = moment().format('DD/MM/YYYY HH:mm ');
    $('#timedate').val(now); 
	  enquire.register("screen and (min-width: 500px)", function() {

          ///slideshow code here
          $('#timedate').datetimepicker({controlType: 'select'});

      }).listen();
      
      enquire.register("screen and (max-width: 500px)", function() {

          ///slideshow code here
          $('.errors').remove();

      }).listen();
    
	
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
 
    /*
    $('#facebooklogin').click(function(){
	    console.log('test');
	    $('#order').removeClass('nonactive');
	});
	*/
	//Op da form in die box moet jquery validatie komen zodat als die velden zijn ingevuld dat die dan in hidden fields worden gezeten. 
	//Zodat die mee worden gestuurd met de rest van de info in de POST.         
    $('#form1').validate({
	    rules: { 
		    NaamBox: {required: true,
			          minlength: 3},    
		    TelBox: {
			required: true, 
			digits: true},
		    EmailBox: {            
			required: true, 
			email: true }	
		}, 	
		messages: {
			NaamBox: "Gelieve uw naam in te voeren",
			TelBox: "Gelieve uw telefoonnr. zonder tekens in te voeren.",
			EmailBox: "Gelieve een geldig emailadres in te geven."
		}
    });
    
    
    
    $('#verder').click(function(){
    	
    	var valid = $('#form1').valid(); 
    	
    	if(valid){
    	  $.ajax({
		  type: 'GET',
		  url: 'http://maps.googleapis.com/maps/api/distancematrix/json?origins='+$("input[name=adres1]").val()+'&destinations='+$("input[name=adres2]").val()+'&sensor=false',
		  dataType: 'json',
		  success: function(jsonData) {
		  	 $("input[name=Afstand]").val(jsonData.rows[0].elements[0].distance.text);
		  	 $("input[name=naam]").val($("input[name=NaamBox]").val());
    	 	 $("input[name=naam]").val($("input[name=NaamBox]").val());
	    	 $("input[name=tel]").val($("input[name=TelBox]").val());
	    	 $("input[name=email]").val($("input[name=EmailBox]").val());
	    	 $('#order').show();
	    	 $('#help').css('margin-top','-56px').addClass('hidehelp');
	    	 // $('#order').removeClass('nonactive').removeAttr("disabled");
	    	 $('#loginhelp').trigger('reveal:close');
	    	 $('#help').html("Info"); 
		  },
		});

    	}else{
	    	
	    	alert("Form is not valid!"); 
	    	
    	}
    	
    	
    });
      
      
    $("#location").click(function(){huidigeLocatie();});
    
    
    
});

function huidigeLocatie(){
	 getGPS();
 }

function getGPS() {
	if (navigator.geolocation) {  
		navigator.geolocation.getCurrentPosition(showGPS, gpsError);
	} else {  
		alert("No GPS Functionality.");  
	}
}

function gpsError(error) {
	alert("GPS Error: "+error.code+", "+error.message);
}

function showGPS(position) {
	 codeLatLng(position.coords.latitude, position.coords.longitude);
	}

function codeLatLng(lat, lng) {
	geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      	console.log(results);
        if (results[1]) {
          $("#address1").val(results[0].formatted_address);
        }
      } else {
        alert("Adres niet gevonden: " + status);
      }
    });
}


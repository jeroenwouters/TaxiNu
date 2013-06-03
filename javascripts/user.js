$(document).ready(function() {
    var now = moment().format('DD/MM/YYYY HH:mm ');
    

    $('#timedate').val(now); 
	
	$('header').animate({"opacity": 1},300);

	enquire.register("screen and (min-width: 500px)", function() {

          ///slideshow code here
          $('#timedate').datetimepicker({controlType: 'select'});
 		  
 		  $('#address1').one("focus",function(){
 		  		$('.bread').fadeIn();
 		  });

 		  
 		  $('.question_btn').one("click",function(){
 		  		once = true; 
 		  		$('.info').show().animate({
				    top: '-=219', 
				    opacity: '1.0'
				  }, 1000, function() {
				              $('.errors').fadeOut();

				});
 		  });
 		
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

    $('#login').validate({
	    rules: { 
		    loginemail: {            
			required: true, 
			email: true }	
		}, 	
		messages: {
			loginemail: "Geen geldig emailadres."
		}
    });
    
    $('#verder').click(function(){
    	
    	var valid = $('#form1').valid(); 
    	
    	if(valid){
    		$.post("register", { naam: $("input[name=NaamBox]").val(), tel: $("input[name=TelBox]").val(), email: $("input[name=EmailBox]").val(), pass: $("input[name=password]").val() } );
    	  	modelok($("input[name=NaamBox]").val(), $("input[name=TelBox]").val(), $("input[name=EmailBox]").val() );
    	 
    	}else{
	    	
	    	alert("Form is not valid!"); 
	    	
    	}

    });

    $(".loginerror").hide();

	$('#loginbtn').click(function(){
		var valid = $('#login').valid();
		var data = {username: $("input[name=loginemail]").val() ,password: $("input[name=loginpass]").val()};

    	if(valid){
    		$.ajax({
			  type: 'POST',
			  url: 'login',
			  data: data,
			  dataType: 'json',
			  success: function(jsonData) {
			  		if(jsonData != "false"){
			  			console.log(jsonData);
			  			modelok(jsonData[0].naam, jsonData[0].email, jsonData[0].tel);
			  		}else{
			  			$(".loginerror").fadeIn().delay(1000).fadeOut();
			  		}
			  	}
    		});
    	}
	});
      
      
    $("#location").click(function(){huidigeLocatie();});
    
   
    $("#userswitch").click(function () {
		$(".switch").toggle();

		var btntext = $("#userswitch").text(); 

		if(btntext == "bestaande klant"){
			$("#userswitch").text("nieuwe klant");
		}else{
			console.log(btntext);
			$("#userswitch").text("bestaande klant");
		}

	});

    
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

function modelok(naam, email, tel){
	$.ajax({
		  type: 'GET',
		  url: 'http://maps.googleapis.com/maps/api/distancematrix/json?origins='+$("input[name=adres1]").val()+'&destinations='+$("input[name=adres2]").val()+'&sensor=false',
		  dataType: 'json',
		  success: function(jsonData) {
		  	 $("input[name=Afstand]").val(jsonData.rows[0].elements[0].distance.text);
    	 	 $("input[name=naam]").val(naam);
	    	 $("input[name=tel]").val(tel);
	    	 $("input[name=email]").val(email);
	    	 $('#order').show();
	    	 $('#help').css('margin-top','-56px').addClass('hidehelp');
	    	 // $('#order').removeClass('nonactive').removeAttr("disabled");
	    	 $('#loginhelp').trigger('reveal:close');
	    	 $('#help').html("Info"); 
		  	},
		 });
}

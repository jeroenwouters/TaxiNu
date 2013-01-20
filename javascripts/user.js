$(document).ready(function() {
    $('#timedate').datetimepicker();
	
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
    
    $("#settings").click(function() {
      $("#settings_modal").reveal();
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
		    NaamBox: "required",    
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
	    	
	    $("input[name=naam]").val($("input[name=NaamBox]").val());
    	$("input[name=tel]").val($("input[name=TelBox]").val());
    	$("input[name=email]").val($("input[name=EmailBox]").val());
    	
    	$('#order').removeClass('nonactive');
    	$('#loginhelp').trigger('reveal:close');
	    	
    	}else{
	    	
	    	alert("Form is not valid!"); 
	    	
    	}
    	
    	
    });
   var liid; 
    
    $("li").mousedown(function(){
	   liid = $(this).attr('id');
	   console.log("click"); 
    });
    
    $("#extra_kolom_btn p").click(function(){
	    
	    var naamkolom = $('#nieuw_kolom').val(); 
	    var kolomhtml = $('<div class="col" class="new"><h1>'+ naamkolom +'</h1><ul class="ritten"></ul></div>');
	    
	    console.log(naamkolom);
	    $(".wrapper").append(kolomhtml);   
	    
    });

    
    $( "li" ).draggable({
            helper: "clone",
            revert: "invalid",
            cursor: "move",
            
             start: function(e, ui)
             {
	             $(ui.helper).addClass("ui-draggable-helper");
	             $(this).hide();
	         },
	         stop: function(e, ui)
             {
	             $(this).show();
	         }
        });
    
    $( "ul" ).droppable({
            activeClass: "ui-state-default",
            hoverClass: "ui-state-hover",
            drop: function( event, ui ) {
                
                $( "#"+liid ).appendTo( this );
               
                
            }
    }).sortable({items: "li"});
    
    $(".check").click(function(){
    	$('#checkmodal').reveal();
    	id = $(this).parent().attr('id'); 
    	
    	var info = $('#'+id).html();
    	console.log(info); 
    	
    	$('#checkmodal .inforit').html(info);
    	$('#checkmodal .inforit .check').remove();
    	$('#checkmodal .inforit .mark').remove(); 
    
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
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
       
    $('#facebooklogin').click(function(){
	    console.log('test');
	    $('#order').removeClass('nonactive');
	});
	    
	     
    $('#verder').click(function(){
    	$('#order').removeClass('nonactive');
    	$('#loginhelp').trigger('reveal:close');
    });
    
   var liid; 
    
    $("li").mousedown(function(){
	   liid = $(this).attr('id');
	   console.log("click"); 
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
    
});
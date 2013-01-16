	// Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) window.console.log(message);
    };

    // Flash fallback logging - don't include this in production
    WEB_SOCKET_DEBUG = true;

    var pusher = new Pusher('b075ffa0df361cc21bda');
    
    
    var channel = pusher.subscribe('admin_all');
    channel.bind('taxi_bestelt', function(data) {
		
		var splitadres1 = data.adres1.split(',');
		adres1 = splitadres1[1];
		var splitadres2 = data.adres2.split(',');
		adres2 = splitadres1[1];
		var tijd = data.tijd.substr(10, 6)
		   
		$('#col2 li:last').after('<li class="rit" id="'+data.id+'"><img src="http://localhost:8888/TaxiNu/images/drag.png" class="mark" width="20px"><p class="vertrek">'+adres1+'</p><p class="bestemming">'+adres2+'</p><div class="maps"></div><p class="uur">'+tijd+'</p><p class="naamklant">Den Jhon</p><p class="telklant">0475338844</p><button class="thoughtbot check">Check</button></li>');     	
		
		$(".check").click(function(){
    	$('#checkmodal').reveal();
    	id = $(this).parent().attr('id'); 
    	
    	var info = $('#'+id).html();
    	console.log(info); 
    	
    	$('#checkmodal .inforit').html(info);
    	$('#checkmodal .inforit .check').remove();
    	$('#checkmodal .inforit .mark').remove(); 
    
    	}); 	
    	
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

    });
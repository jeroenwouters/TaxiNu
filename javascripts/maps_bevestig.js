 jQuery(window).ready(function(){
         	//Gmaps
         	 var mapOptions = {
              	zoom: 13,
                 center: new google.maps.LatLng(51.283333,4.483333),
                 mapTypeId: google.maps.MapTypeId.ROADMAP
              }
              var map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
              var myLatLng = new google.maps.LatLng(51.283333,4.483333);
              var marker = new google.maps.Marker( {position: myLatLng, map: map} );
                  
           // console.log('taxi:'+taxi+' bedrijf:'+bedrijf);

             // Enable pusher logging - don't include this in production
		     Pusher.log = function(message) {
		       if (window.console && window.console.log) window.console.log(message);
		     };
		
		     // Flash fallback logging - don't include this in production
		      WEB_SOCKET_DEBUG = true;
                Pusher.channel_auth_endpoint = 'pusher/auth.php';
                var pusher = new Pusher('b075ffa0df361cc21bda');
                var channel = pusher.subscribe('private-bedrijf_1');
                channel.bind('client-taxi_1', function(data) {
                   marker.setPosition( new google.maps.LatLng( data.lat, data.lang ) );                
                });



        });

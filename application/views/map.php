<!DOCTYPE html>
<html>
  <head>
  	<style type="text/css">
     html { height: 100% }
     body { height: 100%; margin: 0px; padding: 0px }
     #map-canvas { height: 100% }
   </style>
    <script src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
    <script src="http://js.pusher.com/1.12/pusher.min.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>

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
        
            // Enable pusher logging - don't include this in production
		    Pusher.log = function(message) {
		      if (window.console && window.console.log) window.console.log(message);
		    };
		
		    // Flash fallback logging - don't include this in production
		    WEB_SOCKET_DEBUG = true;
		    Pusher.channel_auth_endpoint = 'http://192.168.0.240:8888/TaxiNu/pusher/auth.php';
		    var pusher = new Pusher('b075ffa0df361cc21bda');
		    var channel = pusher.subscribe('private-bedrijf_1');
		    channel.bind('client-taxi_1', function(data) {
		    	 marker.setPosition( new google.maps.LatLng( data.lat, data.lang ) );		    	 
		    });
        });
    </script>
  </head>
  <body>
    <div id="map-canvas"></div><div>
    
  </body>
</html>
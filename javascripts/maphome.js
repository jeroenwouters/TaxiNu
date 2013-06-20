 $(document).ready(function() {
   Pusher.channel_auth_endpoint = 'pusher/auth.php';
   var pusher = new Pusher('b075ffa0df361cc21bda');
   var channel = pusher.subscribe('private-alltaxi');
   var mapOptions = {
     zoom: 13,
     center: new google.maps.LatLng(51.283333, 4.483333),
     mapTypeId: google.maps.MapTypeId.ROADMAP,
     scrollwheel: false,
   }
   var map = new google.maps.Map(document.getElementById('homemap'), mapOptions);
   var markers = [];
   Pusher.log = function(message) {
     if (window.console && window.console.log) window.console.log(message);
   };

   channel.bind('client-taxis', function(data) {
     var myLatLng = new google.maps.LatLng(data.lat, data.lang);
     // if(markers[data.taxi]){
     //   markers[data.taxi] = (new google.maps.Marker( {position: myLatLng, map: map, icon: base_url+'images/taxi.png', width: '10px'} ));
     // }else{
     //   markers[data.taxi].setPosition(myLatLng);
     // }
     var newtaxi = 1;
     for (var i = 0; i < markers.length; i++) {
       if (markers[i].id === data.taxi) {
         markers[i].marker.setPosition(myLatLng);
         newtaxi = 0;
       }
     }
     if (newtaxi == 1) {
       markers.push({
         id: data.taxi,
         marker: new google.maps.Marker({
           position: myLatLng,
           map: map,
           icon: base_url + 'images/taxi.png',
           width: '10px'
         })
       });
     }
   });
 });
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
  channel.bind('client-taxis', function(data) {
    var myLatLng = new google.maps.LatLng(data.lat, data.lang);
    if (marker[data.taxi]) {
      marker[data.taxi] = (new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: base_url + 'images/taxi.png',
        width: '10px'
      }));
    } else {
      marker[data.taxi].setPosition(myLatLng);
    }
  });
});
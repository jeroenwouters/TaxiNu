  var channel;
  var channel2;
  var marker;

  jQuery(window).ready(function() {
    //voorlopig
    $('header').animate({
      "opacity": 1
    }, 300);

    //Gmaps
    var mapOptions = {
      zoom: 13,
      center: new google.maps.LatLng(51.283333, 4.483333),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    var myLatLng = new google.maps.LatLng(51.283333, 4.483333);
    marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      icon: base_url + 'images/taxi.png'
    });

    // Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) window.console.log(message);
    };

    // Flash fallback logging - don't include this in production
    WEB_SOCKET_DEBUG = true;
    Pusher.channel_auth_endpoint = base_url + 'pusher/auth.php';
    var pusher = new Pusher('b075ffa0df361cc21bda');
    channel = pusher.subscribe('private-bedrijf_' + bedrijf);

    channel.bind('client-taxi_' + taxi, function(data) {
      marker.setPosition(new google.maps.LatLng(data.lat, data.lang));
    });

    channel2 = pusher.subscribe('admin_all');

    channel2.bind('taxi_destroy_' + taxi, function(data) {
      changetaxi(data.nieuwtaxi);
    });
    channel.bind('taxis', function(data) {
      var myLatLng = new google.maps.LatLng(data.lat, data.lang);
      if (marker[data.taxi]) {
        marker[data.taxi] = (new google.maps.Marker({
          position: myLatLng,
          map: map,
          icon: base_url + 'images/taxi.png'
        }));
      } else {
        marker[data.taxi].setPosition(myLatLng);
      }
    });

  });


  function changetaxi(newtaxi) {
    channel2.unbind('taxi_destroy_' + taxi);
    channel.unbind('client-taxi_' + taxi);
    taxi = newtaxi;
    channel2.bind('taxi_destroy_' + taxi, function(data) {
      changetaxi(data.nieuwtaxi);
    });
    channel.bind('client-taxi_' + taxi, function(data) {
      marker.setPosition(new google.maps.LatLng(data.lat, data.lang));
    });
  }
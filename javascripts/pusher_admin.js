	// Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) window.console.log(message);
    };

    // Flash fallback logging - don't include this in production
    WEB_SOCKET_DEBUG = true;

    var pusher = new Pusher('b075ffa0df361cc21bda');
    
    
    var channel = pusher.subscribe('admin_all');
    channel.bind('taxi_bestelt', function(data) {
     	$('#taxibestellingen tr:last').after('<tr><td>'+data.adres1+'</td><td>'+data.adres2+'</td><td>'+data.tijd+'</td><td>'+data.personen+'</td><td><a href="http://localhost:8888/TaxiNu/index.php/admin/bevestigtaxi/'+data.id+'">Ok</a></td></tr>');
    });
	// Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) window.console.log(message);
    };

    // Flash fallback logging - don't include this in production
    WEB_SOCKET_DEBUG = true;

    var pusher = new Pusher('b075ffa0df361cc21bda');
    
    
    var channel = pusher.subscribe('client');
    channel.bind('client_'+$('#hiddenid').val(), function(data) {
     	$('#taxibestellingen tr:last').after('<tr><td>'+data.bedrijf+'</td>/tr>');
    });
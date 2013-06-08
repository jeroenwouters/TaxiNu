	// Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) window.console.log(message);
    };

    // Flash fallback logging - don't include this in production
    WEB_SOCKET_DEBUG = true;

    var pusher = new Pusher('b075ffa0df361cc21bda');
    
    
    var channel = pusher.subscribe('client');
    channel.bind('client_'+$('#hiddenid').val(), function(data) {
    	console.log(data.fkUser);
    	$('#bedrijven').append('<li><p>'+data.Username+'</p><p>Wachttijd: <span class="minutes">'+data.Wachttijd+'</span> min.</p><a href="'+base_url+'home/bevestig/'+data.fkBestelling+'/'+data.fkUser+'"><button class="thoughtbot">Bevestig</button>');
    });

    $(document).ready(function() {
        $(window).bind('beforeunload', function() {
            $.post(base_url+'home/setemail',{id:bestelling_id});
        }); 
    });
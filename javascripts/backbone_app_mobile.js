
//Backbone Options
Backbone.emulateHTTP = true
var current_user_id;
var current_user_login;
//Models

var User = Backbone.Model.extend({
	url: 'admin/getuser',
	
	parse: function(data, options) {
		current_user_id = data.id;
		console.log(data.username);
		current_user_login = data.username;
	}
})


//Views


//Router

var AdminPanel = new (Backbone.Router.extend({
	routes: {"": "index"}, 
	
	initialize: function(){
		this.user = new User();
	},
	start: function(){
		Backbone.history.start({pushState: true});
		this.user.fetch();
	},
	index: function(){
		this.user.fetch();
	}
}));

//Pusher

//Allen Test
// Enable pusher logging - don't include this in production
/*
Pusher.log = function(message) {
  if (window.console && window.console.log) window.console.log(message);
};
*/
// Flash fallback logging - don't include this in production
WEB_SOCKET_DEBUG = true;
//Stop Test

	var pusher = new Pusher('b075ffa0df361cc21bda');
    
    
    var channel = pusher.subscribe('admin_all');
    channel.bind('taxi_bestelt', function(data) {

    });
    

//Document 
$(document).ready(function() {
	AdminPanel.start();
	$('li').swipe( {
			triggerOnTouchEnd : true,
			swipeStatus : swipeStatus,
			allowPageScroll:"vertical",
		});
	$('.naamklant').html($('.wrapper').width());
});

function swipeStatus(event, phase, direction, distance, fingers)
{
	var cancelpx = $('.wrapper').width()*0.7;

	if( phase=="move" && direction=="right" ){
		$('li').css("margin-left", distance);
	}

	if( phase=="move" && (direction=="left" || direction=="right") ){
		if(distance > cancelpx){
			$('li').css("opacity", "0.5");
			remove = 1;
		}else{
			$('li').css("opacity", "1");
			remove = 0;
		}
	}

	if( phase=="cancel"){
		$('li').animate({
			marginLeft: "5%",
		}, 250);
	}

	if( phase=="end"){
		if(distance > cancelpx){
			$('li').animate({
				marginLeft: "100%",
			}, 250).done(function(){
				$('li').remove();
			});
		}else{
			$('li').animate({
				marginLeft: "5%",
			}, 250);
		}
	}

	
}



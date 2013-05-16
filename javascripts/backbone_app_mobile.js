
//Backbone Options
Backbone.emulateHTTP = true
var current_user_id;
var current_user_login;
//Models

var User = Backbone.Model.extend({
	url: 'admin/getuser',
	
	parse: function(data, options) {
		current_user_id = data.id;
		current_user_login = data.username;
		AdminPanel.rittenList.fetch( { data: { userid: data.id} });
		var channel = pusher.subscribe('admin_all');
	    channel.bind('taxi_'+current_user_id, function(data) {
	    	var newrit = new Rit(data);
    		AdminPanel.rittenList.add(newrit);
	    });
	}
})

var Rit = Backbone.Model.extend({
	
});

var RittenList = Backbone.Collection.extend({
	model: Rit,
	url: 'api/ritten',
});

//Views
var RittenView = Backbone.View.extend({
  template: Handlebars.compile(rit_tempalte),
  
  render: function(){
  	this.$el.html(this.template(this.model.toJSON()));
    if(this.model.get('status') == 3){
		this.$el.css('background-color', 'green');
	}

	if(this.model.get('status') == 2){
		this.$el.css("background-color", "red");
	}
    return this;
  },
  
});

var RittenListView = Backbone.View.extend({
	initialize: function(){
		this.collection.on('add', this.addOne, this);
		this.collection.on('reset', this.addAll, this);
	},
	
	addOne: function(rit){	
		console.log(rit);	
		var rittenView = new RittenView({model: rit});
		$('.wrapper ul').append(rittenView.render().el);
	},
	
	addAll: function(){
		this.collection.forEach(this.addOne, this);
	},
	
	render: function(){
		this.addAll();
	}
});

//Router

var AdminPanel = new (Backbone.Router.extend({
	routes: {"": "index"}, 
	
	initialize: function(){
		this.user = new User();
		this.rittenList = new RittenList();
		this.rittenListView = new RittenListView({collection: this.rittenList});
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
    
    
    
    

//Document 
$(document).ready(function() {
	AdminPanel.start();
	$('li').swipe( {
			triggerOnTouchEnd : true,
			swipeStatus : swipeStatus,
			allowPageScroll:"vertical",
		});
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



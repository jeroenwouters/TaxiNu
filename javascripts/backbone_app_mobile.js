
//Backbone Options
Backbone.emulateHTTP = true
var current_user_id;
var current_user_login;
var channel2;

//map vals
var map
  , you
  , pos
  , t_0
  , log = ''
  , url = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAARCAYAAADdRIy+AAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9sBHxAxMpOb3XcAAAOBSURBVDjLfZRNa1xlGIav877nY2bOzJnMR77TNIkJpSpBW4qiGGJAECpSEFz0D/gDKrp9wVVBXPkLXLkrqBtBZKJFQaqghbZp09SkTUwyH5mvMzPnvHPOcZEUumj6wL17nmvz3PdtcMoopQRg27btdpYvXQSS7N9/3NZaB0BHKTV83p3xHJAFzFQWVj4bdPjonGsXisIwm35Iy2C40dON0VHrxurD9evAvlKqfypQKeW15l9d/enI+9qr+2fWXplmcbpA0UtT6wx48OSIu4/r3Nqqkjs3tvN+/uiat31vHagppRIA8xnYBPnShRub1reiUU0vX5gnPTlKfjzPzEiKIBPg4GDFNrlmwJ2bW7O981PfXM1mP7b73T+B/wDECSwTRdHi9/L8V9t399Le3BSMT0B+BDIukWkTp1ySfIF4bJzk7ByMlfn3zl76x/RrXwohlpRSRQCplDKAs9uzF6/+/Oveh1GpyOjSAsWJUUbyOTK2hU4EDS05HNocxDYHkaQRG9Dr03hULU8vz9e9o92ttbW1ugA8YGrTz7wT6JhkbJJBdoSelaMTSGoD2O1DLYB2CD1t03dKUJyAyUmCgWbTz6w4jlMA0ibgSim9Wms4S2EEcnk6Ikd7KKkDMoaUgC5QF9CS0MWEdB68IhQK1FrRDIICkDUBUwhh+M3Aw3XBcakmKUoGuAZEBlgG9CVUTWiY0JaAnYFUBtwsfifwyJMAlglorXXsOk6bSGbBJLIk94cwAM5YYNvQT6CewKEFiQNoEwwbTBs3JduABnwT8E3T9MuOfLzRjaeIYpAJ2jJ4aMC2AVb62FrBEGILsAGRQJxAklB2zZ1EJwOgJ4DOcDjcfSnT+8XRIQwGEA6ODWXAUELfPlZsnkRBAFpDEOBEmsW0fzMMwyqgZaVSYXV1NSyFh61mbumtvX5SJpuBnAupp04FQqAHBIAP1Jqwf8DreePepc5v16WU95VSwdN1P47jB5ed29fmDO1TrUOtDZ0TSPNEPU7e3YVagzmh/feSW58KITaUUl0ACVCpVKhUKv67b7+xP1/K/NXxs282+kEhiQEtIBTQS+BIw2ELeVDl5V536wNv+xPXf/K7Uqr+oraxgdF19/Lnjyz3is6mygeYaQwYJ+5b3aC2EHa+W/F/+AJoKKX0C+vrGbABpCzLyvqzK8uJIaPcTuWfMAw10D+tD/8H7d6IDx2EfHUAAAAASUVORK5CYII='
  , head = '["latitude","longitude","precision","time"]'
  , zoom
  , time
  , from
  ;
var geocoder = new google.maps.Geocoder();
var markerBounds = new google.maps.LatLngBounds();
var markers = new Array();
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();

//Models

var User = Backbone.Model.extend({
	url: 'admin/getuser',
	
	parse: function(data, options) {
		current_user_id = data.id;
		current_user_login = data.username;
		channel2 = pusher.subscribe('private-bedrijf_'+data.fkUser);
		AdminPanel.rittenList.fetch( { data: { userid: data.id} });
		var channel = pusher.subscribe('admin_all');
	    channel.bind('taxi_'+current_user_id, function(data) {
	    	var newrit = new Rit(data);
    		AdminPanel.rittenList.add(newrit);
	    });
	    channel.bind('green_taxi_'+current_user_id, function(data) {
	    	$('#'+data).css('background', 'green');
	    });
	     channel.bind('taxi_destroy_'+current_user_id, function(data) {
	    	var rit = AdminPanel.rittenList.get(data.id);
	    	AdminPanel.rittenList.remove(rit);
	    	$('#'+data.id).remove();
	    });
	}
})

var Rit = Backbone.Model.extend({
	setstatus: function(status){
		this.set({
			'status': status, 
			'userid': current_user_id
		});
		this.save();
	}
});

var RittenList = Backbone.Collection.extend({
	model: Rit,
	url: 'api/ritten',
});

//Views
var RittenView = Backbone.View.extend({
  tagName: 'li',
  className: 'rit',

  template: Handlebars.compile(rit_tempalte),

  events: {
  	"click" : "map",
  	'touchstop' : "map"
  },
  
  render: function(){
  	this.$el.html(this.template(this.model.toJSON()));
  	
    if(this.model.get('status') == 3){
		this.$el.css('background', 'green');
	}

	if(this.model.get('status') == 2){
		this.$el.css("background", "red");
	}

	if(this.model.get('status') == 4){
		this.$el.css("background", "orange");
		enable_swipe_destory(this.$el, this.model);
	}
	
	if(this.model.get('status') == 5){
		this.$el.swipe("destroy");
		this.$el.css("opacity", "0.5");
	}

    return this;
  },

  map: function(){
  	var ritMapView = new RitMapView({model: this.model});
  	$('#maprit').css("height", "100px");
  	$('#maprit').html(ritMapView.render().el);
  	$.ajax({
		type: 'GET',
		url: 'http://maps.googleapis.com/maps/api/distancematrix/json?origins='+pos+'&destinations='+this.model.get("adres1")+'&sensor=false',
		dataType: 'json',
		success: function(jsonData) {
		  	$("#afstandpos").html(jsonData.rows[0].elements[0].distance.text);
		 },
	});
	if(this.model.get('status') != 3){
		$('#passagier').hide();
	}
  }
  
});

var RitMapView = Backbone.View.extend({
	template: Handlebars.compile(rit_map_template),

	events: {
  		"click" : "open",
  		"click #passagier" : "statusto4"
  	},

	render: function(){
		clearOverlays();
		calcRoute(this.model.get('adres1'),this.model.get('adres2'));
		showmap();
		$('#maprit').show();
		this.$el.html(this.template(this.model.toJSON()));
		return this;
	}, 

	open: function(){
		$('#maprit').css("height", "auto");
	},

	statusto4: function(){
		this.model.setstatus(4);
		this.$el.find('#passagier').hide();
		$('#'+this.model.get('id')).css("background", "orange");
		$('.wrapper ul').find(".status4").before($('#'+this.model.get('id')));
		enable_swipe_destory($('#'+this.model.get('id')), this.model)
	}
});

var RittenListView = Backbone.View.extend({
	initialize: function(){
		this.collection.on('add', this.addOne, this);
		this.collection.on('reset', this.addAll, this);
	},
	
	addOne: function(rit){	
		geocoder.geocode( { 'address': rit.get('adres1')}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location
				});
				markers.push(marker);
				markerBounds.extend(results[0].geometry.location);
				map.fitBounds(markerBounds);
			} else {
			alert("Geocode was not successful for the following reason: " + status);
			}
		});
		var rittenView = new RittenView({model: rit, id: rit.get('id')});
		//$('.wrapper ul').append(rittenView.render().el);
		if(rit.get('status') == 4){
			$('.wrapper ul').find(".status4").before(rittenView.render().el);
		}
		if(rit.get('status') == 2 || rit.get('status') == 3){
			$('.wrapper ul').find(".status4").after(rittenView.render().el);
		}
		if(rit.get('status') == 5){
			$('.wrapper ul').find(".afgerond").after(rittenView.render().el);
		}
	},
	
	addAll: function(){
		this.collection.forEach(this.addOne, this);
		this.collection.forEach(this.volegorde, this);
	},
	
	render: function(onlymarkers){
		if(onlymarkers == true){
			this.collection.forEach(this.onlymarkers, this);
		}else{
			this.addAll();
		}
	},

	onlymarkers: function(rit){
		directionsDisplay.setMap(null);
		geocoder.geocode( { 'address': rit.get('adres1')}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location
				});
				markers.push(marker);
				markerBounds.extend(results[0].geometry.location);
				map.fitBounds(markerBounds);
			} else {
			alert("Geocode was not successful for the following reason: " + status);
			}
		});
	},

	volegorde: function(rit){
		if(rit.get('status') == 5){
			$('#'+rit.get('id')).appendTo('.wrapper ul');
		}
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

Pusher.log = function(message) {
  if (window.console && window.console.log) window.console.log(message);
};

// Flash fallback logging - don't include this in production
WEB_SOCKET_DEBUG = true;
//Stop Test
	Pusher.channel_auth_endpoint = 'pusher/auth.php';
	var pusher = new Pusher('b075ffa0df361cc21bda');
    
    

//Document 
$(document).ready(function() {
	AdminPanel.start();
	init();

	$("#list").hide();
	$("#loc").hide();
	$("#maprit").hide();

	$("#world").click(function(){
		AdminPanel.rittenListView.render(1);
		showmap();
	});

	$("#list").click(function(){
		$("#lijst").animate({
			marginLeft: "-0%",
		}, 250);
		$("#map").animate({
			marginLeft: "100%",
		}, 250);
		$("#world").show();
		$("#set").show();
		$("#list").hide();
		$("#loc").hide();
		$("#maprit").hide();
	});

	$("#loc").click(function(){
		 map.panTo(pos);
	});
});


function init() {
  directionsDisplay = new google.maps.DirectionsRenderer();
  map = new google.maps.Map( document.getElementById('map')
                           , { zoom: zoom
                             , mapTypeId: google.maps.MapTypeId.ROADMAP
                             });
  if (navigator.geolocation)
    navigator.geolocation.watchPosition(gotPosition, function() {
      noGeolocation('Error: The Geolocation service failed.');
    }, { enableHighAccuracy: true, maximumAge: 10e3, timeout: 20e3 });
  else
    noGeolocation('Error: Your browser doesn\'t support geo.');
}

function gotPosition(position) {
  var at  = position.coords
    , off = at.accuracy
    , z
    ;

  pos = ll(at.latitude, at.longitude);
  if (you) you.setPosition(pos); else {
    t_0 = Math.round(+new Date / 1000);
    you = new google.maps.Marker({ map: map
                                 , position: pos
                                 , icon: marker(url, s(20, 17), p(10, 8))
                                 });
    google.maps.event.addListener(you, 'click', function() {
      location = 'mailto:?subject=GPS%20Track&body='
               + encodeURIComponent(log + ' ]\n}\n');
    });
  }
  if (!zoom) map.setCenter(pos);

  // zoom in, as precision improves (or out again)
  if (off > 2e3) z = 15;
  if (off < 2e3) z = 16;
  if (off < 900) z = 17;
  if (off < 100) z = 18;
  if (z !== zoom) map.setZoom(zoom = z);

  map.fitBounds(markerBounds);

   channel2.trigger('client-taxi_'+current_user_id, { lat: position.coords.latitude, lang: position.coords.longitude });
}

function noGeolocation(message) {
  var opts = { map: map
             , position: ll(60, 105)
             , content: message
             }
    , info = new google.maps.InfoWindow(opts);
  map.setCenter(opts.position);
}

function s(w, h) { return new google.maps.Size(w, h); }
function p(x, y) { return new google.maps.Point(x, y); }
function ll(y, x) { return new google.maps.LatLng(y, x); }
function marker(url, size, hotspot, origin) {
  return new google.maps.MarkerImage(url, size, origin || p(0, 0), hotspot);
}

function clearOverlays() {
  for (var i = 0; i < markers.length; i++ ) {
    markers[i].setMap(null);
  }
}

function calcRoute(start, end) {
	directionsDisplay.setMap(map);

	var waypts = [];
	 waypts.push({
          location:start,
          stopover:true}
     );

	var request = {
		origin:pos,
		destination:end,
		 waypoints: waypts,
		travelMode: google.maps.DirectionsTravelMode.DRIVING
	};
	directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
		    directionsDisplay.setDirections(response);
		 }
	});
}

function showmap(){
	$("#lijst").animate({
		marginLeft: "-100%",
	}, 250);
	$("#map").animate({
		marginLeft: "0%",
	}, 250);
	$("#world").hide();
	$("#set").hide();
	$("#list").show();
	$("#loc").show();
}

function enable_swipe_destory(elswipe, rit){
  	elswipe.swipe( {
		triggerOnTouchEnd : true,
		swipeStatus : function(event, phase, direction, distance, fingers)
		{
			var cancelpx = $('.wrapper').width()*0.7;

			if( phase=="move" && direction=="right" ){
				console.log('siwpe');
				$(this).css("margin-left", distance);
			}

			if( phase=="move" && (direction=="left" || direction=="right") ){
				if(distance > cancelpx){
					$(this).css("opacity", "0.5");
					remove = 1;
				}else{
					$(this).css("opacity", "1");
					remove = 0;
				}
			}

			if( phase=="cancel"){
				$(this).animate({
					marginLeft: "5%",
				}, 250);
			}

			if( phase=="end"){
				if(distance > cancelpx){
					$(this).animate({
						marginLeft: "100%",
					}, 250,  function() {
				 		$('.wrapper ul').append(this);
						$(this).css('margin-left', "5%");
						$(this).swipe("destroy");
						$(this).css('background-color', "");
						rit.setstatus(5);
					});
				}else{
					$(this).animate({
						marginLeft: "5%",
					}, 250);
				}
			}
		},
		allowPageScroll:"vertical",
	});
}
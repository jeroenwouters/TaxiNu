//Backbone.emulateHTTP = true

//Models

var Bestelling = Backbone.Model.extend({});

var BestellingList = Backbone.Collection.extend({
	model: Bestelling,
	url: 'http://localhost:8888/TaxiNu/api/bestelling/'
});

//Views
var BestellingView = Backbone.View.extend({
  //template: _.template('<li class="rit" id="<%= id %>"><img src="http://localhost:8888/TaxiNu/images/drag.png" class="mark" width="20px"><p class="vertrek"><%= adres1 %></p><p class="bestemming"><%= adres2 %></p><div class="maps"></div><p class="uur"><%= tijd %></p><p class="naamklant">Den Jhon</p><p class="telklant">0475338844</p><button class="thoughtbot check">Check</button></li>'),
  template: Handlebars.compile(bestelling_tempalte),
  
  render: function(){
    this.$el.html(this.template(this.model.toJSON()));
    return this;
  }
});

var BestellingListView = Backbone.View.extend({
	initialize: function(){
		this.collection.on('add', this.addOne, this);
		this.collection.on('reset', this.addAll, this);
	},
	
	addOne: function(bestelling){
		var bestellingView = new BestellingView({model: bestelling});
		this.$el.append(bestellingView.render().el);
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
		this.bestellingList = new BestellingList();
		this.bestellingListView = new BestellingListView({collection: this.bestellingList});
		$('#col1 ul').append(this.bestellingListView.el);
	},
	start: function(){
		Backbone.history.start({pushState: true});
		this.bestellingList.fetch();
	},
	index: function(){
		this.bestellingList.fetch();
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

	var pusher = new Pusher('b075ffa0df361cc21bda');
    
    
    var channel = pusher.subscribe('admin_all');
    channel.bind('taxi_bestelt', function(data) {
    	var newbestelling = new Bestelling(data);
    	AdminPanel.bestellingList.add(newbestelling);
    });
    
//Document 

$(document).ready(function() {
	console.log('document ready!');//Alleen Test
	AdminPanel.start();
});




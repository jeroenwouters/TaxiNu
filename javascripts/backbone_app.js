//Backbone.emulateHTTP = true

//Models

var Bestelling = Backbone.Model.extend({
	setstatus: function(newstatus){
		this.set({
		'status': newstatus,
		'wachttijd': $('.wachttijd').val()
		});
		this.save();
	}
});

var BestellingList = Backbone.Collection.extend({
	model: Bestelling,
	url: 'http://localhost:8888/TaxiNu/api/bestelling/'
});

//Views
var BestellingView = Backbone.View.extend({
  template: Handlebars.compile(bestelling_tempalte),
  
  events: {
	  "click button" : "showmodule", 
  },
  
  render: function(){
    this.$el.html(this.template(this.model.toJSON()));
    return this;
  },
  
  showmodule: function(){
  	  var bestellingRevealView = new BestellingRevealView({model: this.model});
	  $('#checkmodal').reveal();
	  $('#checkmodal .inforit').html(bestellingRevealView.render(this.model.get('status')).el);
	  //$('#checkmodal .go').click(;
  }
});

var BestellingRevealView = Backbone.View.extend({
	template1: Handlebars.compile(module_bestelling_template1),
	template2: Handlebars.compile(module_bestelling_template2),
	
	events: {
		"click button" : "go",
	},
	
	render: function(status){
		if(status == 1 || status == 3){
			this.$el.html(this.template1(this.model.toJSON()));
		}
		if(status == 2){
			this.$el.html(this.template2(this.model.toJSON()));
		}
		return this;
	},
	
	go: function(){
		this.model.setstatus(2);
		$('#'+this.model.get('id')).remove();
		$('#checkmodal').trigger('reveal:close');
		var bestellingView = new BestellingView({model: this.model});
		$('#col'+this.model.get('status')+' ul').append(bestellingView.render(this.model.get('status')).el);
	}
});

var BestellingListView = Backbone.View.extend({
	initialize: function(){
		this.collection.on('add', this.addOne, this);
		this.collection.on('reset', this.addAll, this);
	},
	
	addOne: function(bestelling){
		console.log(bestelling.get('status'));
		if(bestelling.get('afgerond') == null || bestelling.get('status') == 3){
			var bestellingView = new BestellingView({model: bestelling});
			$('#col'+bestelling.get('status')+' ul').append(bestellingView.render().el);
		}
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
		//$('#col1 ul').append(this.bestellingListView.el);
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
    	//AdminPanel.bestellingList.fetch();
    });
    
    channel.bind('admin_'+$('#hiddenid').val(), function(data) {
    	$('#'+data).remove();
    	var modelget = AdminPanel.bestellingList.get(data);
    	var bestellingView = new BestellingView({model: modelget});
		$('#col3 ul').append(bestellingView.render(3).el);
    });
    
     channel.bind('delete', function(data) {
     	if(data.iduser != $('#hiddenid').val()){
	     	$('#'+data.idbestelling).remove();
     	}
     });
//Document 

$(document).ready(function() {
	console.log('document ready!');//Alleen Test
	AdminPanel.start();
});

    $( "col1 ul" ).droppable({
            activeClass: "ui-state-default",
            hoverClass: "ui-state-hover",
            drop: function( event, ui ) {
                
                $( "#"+liid ).appendTo( this );
               
                
    }
    }).sortable({items: "li"});

    $( "col2 ul" ).droppable({
            activeClass: "ui-state-default",
            hoverClass: "ui-state-hover",
            drop: function( event, ui ) {
                
                $( "#"+liid ).appendTo( this );
               
                
    }
    }).sortable({items: "li"});




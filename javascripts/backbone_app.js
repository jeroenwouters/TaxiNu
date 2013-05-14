
//Backbone Options
Backbone.emulateHTTP = true

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
	url: 'api/bestelling/'
});

var Taxi = Backbone.Model.extend({
	
});

var TaxiList = Backbone.Collection.extend({
	model: Taxi,
	url: 'api/taxi/'
});

var User = Backbone.Model.extend({
	url: 'admin/getuser',
	
	parse: function(data, options) {
		AdminPanel.taxiList.fetch( { data: { userid: data.id} });
	}
})


//Views
var BestellingView = Backbone.View.extend({
  template: Handlebars.compile(bestelling_tempalte),
  template2: Handlebars.compile(bestelling_tempalte2),
  
  events: {
	  "click button" : "showmodule",
  },
  
  render: function(status){
  	if(status == 3){
	  	this.$el.html(this.template2(this.model.toJSON()));
  	}else{
    	this.$el.html(this.template2(this.model.toJSON()));
    }
    this.$el.draggable({
            helper: "clone",
            revert: "invalid",
            cursor: "move",
            
             start: function(e, ui)
             {
	             $(ui.helper).addClass("ui-draggable-helper");
	             $(this).hide();
	         },
	         stop: function(e, ui)
             {
	             $(this).show();
	         }
        });
    return this;
  },
  
  showmodule: function(){
  	  var bestellingRevealView = new BestellingRevealView({model: this.model});
	  $('#checkmodal').reveal();
	  $('#checkmodal .inforit').html(bestellingRevealView.render(this.model.get('status')).el);
	  //$('#checkmodal .go').click(;
  },

});

var BestellingRevealView = Backbone.View.extend({
	template1: Handlebars.compile(module_bestelling_template1),
	template2: Handlebars.compile(module_bestelling_template2),
	
	events: {
		"click button" : "go",
	},
	
	render: function(status){
		if(status == 1 || status == 3){
			this.$el.html(this.template2(this.model.toJSON()));
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
			$('#col'+bestelling.get('status')+' ul').append(bestellingView.render(bestelling.get('status')).el);
		}
	},
	
	addAll: function(){
		this.collection.forEach(this.addOne, this);
	},
	
	render: function(){
		this.addAll();
	}
});

var TaxiView = Backbone.View.extend({
  className: "col",

  events: {
		"drop" : "dropped",
	},

  template: Handlebars.compile(taxi_template),
  
  render: function(){
	 this.$el.html(this.template(this.model.toJSON()));
	 this.$el.droppable({
         activeClass: "ui-state-default",
         hoverClass: "ui-state-hover",
      }).sortable({items: "li"});
    return this;
  },

  dropped: function(event, ui){
    this.$el.find('.ritten').append(ui.draggable);
  }
  
});

var TaxiListView = Backbone.View.extend({
	initialize: function(){
		this.collection.on('add', this.addOne, this);
		this.collection.on('reset', this.addAll, this);
	},
	
	addOne: function(taxi){
		var taxiView = new TaxiView({model: taxi});
		$('.wrapper').append(taxiView.render().el);
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
		this.taxiList = new TaxiList();
		this.taxiListView = new TaxiListView({collection: this.taxiList});
		this.user = new User();
		//$('#col1 ul').append(this.bestellingListView.el);
	},
	start: function(){
		Backbone.history.start({pushState: true});
		this.bestellingList.fetch();
		this.user.fetch();
	},
	index: function(){
		this.bestellingList.fetch();
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
		col3drag();
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

$("#extra_kolom_btn p").click(function(){
	    
	    var naamkolom = $('#nieuw_kolom').val(); 
	    var kolomhtml = $('<div class="col new"><h1>'+ naamkolom +'</h1><ul class="ritten"></ul></div>');
	    
	    console.log(naamkolom);
	    $(".wrapper").append(kolomhtml);   
	    col3drag();
    });

 $("#settings").click(function() {
      $("#settings_modal").reveal();
    });
 


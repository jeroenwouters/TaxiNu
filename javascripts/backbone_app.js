
//Backbone Options
Backbone.emulateHTTP = true
var current_user_id;
var current_user_login;
//Models

var Bestelling = Backbone.Model.extend({
	setstatus: function(newstatus){
		this.set({
			'status': newstatus,
			'wachttijd': $('.wachttijd').val(),
		});
		this.save();
	}, 
});

var BestellingList = Backbone.Collection.extend({
	model: Bestelling,
	url: 'api/bestelling/'
});

var Taxi = Backbone.Model.extend({
	
});

var TaxiList = Backbone.Collection.extend({
	model: Taxi,
	url: 'api/taxi/',
});

var User = Backbone.Model.extend({
	url: 'admin/getuser',
	
	parse: function(data, options) {
		current_user_id = data.id;
		current_user_login = data.username;
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
  
  render: function(){
   if(!(this.model.get('status') == 1 && this.model.get('afgerond') == 1)){

	   		this.$el.html(this.template2(this.model.toJSON()));
	    	
		
	    if(this.model.get('status') == 3){
			this.$el.css('background-color', 'green');
			enable_drag(this.$el);
		}

		if(this.model.get('status') == 2){
			this.$el.css("background-color", "red");
			enable_drag(this.$el);
		}

		if(this.model.get('status') == 4){
			this.$el.css("background-color", "orange");
		}

		if(this.model.get('status') == 5){
			this.$el.css("opacity", "0.5");
		}
	    return this;
	}
  },
  
  showmodule: function(){
  	  var bestellingRevealView = new BestellingRevealView({model: this.model});
	  $('#checkmodal').reveal();
	  $('#checkmodal .inforit').html(bestellingRevealView.render(2).el);
  },


});

var BestellingRevealView = Backbone.View.extend({
	template1: Handlebars.compile(module_bestelling_template1),
	template2: Handlebars.compile(module_bestelling_template2),
	
	events: {
		"click button" : "go",
	},
	
	render: function(temp){
		if(temp == 1){
			this.$el.html(this.template1(this.model.toJSON()));
		}
		if(temp == 2){
			this.$el.html(this.template2(this.model.toJSON()));
		}

		return this;
	},
	
	go: function(){
		this.model.setstatus(2);
		$('#'+this.model.get('id')).css("background-color", "red");
		// $('#'+this.model.get('id')).remove();
		$('#checkmodal').trigger('reveal:close');
		// var bestellingView = new BestellingView({model: this.model});
		// $('#col'+this.model.get('status')+' ul').append(bestellingView.render(this.model.get('status')).el);
	}
});

var BestellingListView = Backbone.View.extend({
	initialize: function(){
		this.collection.on('add', this.addOne, this);
		this.collection.on('reset', this.addAll, this);
	},
	
	addOne: function(bestelling){
		
		var bestellingView = new BestellingView({model: bestelling});
		if(bestelling.get('taxi') == 0){
			$('#col1 ul').prepend(bestellingView.render().el);
		}else{
			if(bestelling.get('status') == 4){
				$('#taxi_'+bestelling.get('taxi')+' ul').find(".status4").before(bestellingView.render().el);
			}
			if(bestelling.get('status') == 2 || bestelling.get('status') == 3){
				$('#taxi_'+bestelling.get('taxi')+' ul').find(".status4").after(bestellingView.render().el);
			}
			if(bestelling.get('status') == 5){
				$('#taxi_'+bestelling.get('taxi')+' ul').find(".afgerond").after(bestellingView.render().el);
			}
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
  	 this.el.id = 'taxi_' + this.model.get('id');
	 this.$el.html(this.template(this.model.toJSON()));
	 this.$el.droppable({
         activeClass: "ui-state-default",
         hoverClass: "ui-state-hover",
      }); 
      //.sortable({items: "li"});
    return this;
  },

  dropped: function(event, ui){
    this.$el.find('.ritten').find('.afgerond').before(ui.draggable);
    var dragid = ui.draggable.find('li').attr('id');
    var dragged = ui.draggable;
    var bestelling = AdminPanel.bestellingList.get(dragid);
    var taxioud = bestelling.get('taxi');
    bestelling.set({
    	'taxioud' : taxioud,
		'taxi': this.model.get('id'),
	});
    var bestellingRevealView = new BestellingRevealView({model: bestelling});
    if(bestelling.get('status') == 1){
		$('#checkmodal').reveal({ 
			"closed": function () {
				if(bestelling.get('status') == 1){
				$('#col1 ul').append(dragged);
				}
			} 
		});
	}else{
		bestelling.save();
	}
	$('#checkmodal .inforit').html(bestellingRevealView.render(1).el);
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
		AdminPanel.bestellingList.fetch();
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

	var pusher = new Pusher('b075ffa0df361cc21bda');
    
    
    var channel = pusher.subscribe('admin_all');
    channel.bind('taxi_bestelt', function(data) {
    	var newbestelling = new Bestelling(data);
    	AdminPanel.bestellingList.add(newbestelling);
    	//AdminPanel.bestellingList.fetch();
    });
    
    channel.bind('admin_'+$('#hiddenid').val(), function(data) {
  //   	$('#'+data).remove();
		var modelget = AdminPanel.bestellingList.get(data.id);
  //   	var bestellingView = new BestellingView({model: modelget});
		// $('#col3 ul').append(bestellingView.render(3).el);
		// col3drag();
		modelget.set({
		'status': data.status,
		});

		if(data.status == 3){
			$('#'+data.id).css('background-color', 'green');
		}

		if(data.status == 4){
			$('#'+data.id).css('background-color', 'orange');
			$('#'+data.id).parent('ul').prepend($('#'+data.id).html());
		}
	});
    
     channel.bind('delete', function(data) {
     	if(data.iduser != $('#hiddenid').val()){
	     	$('#'+data.idbestelling).remove();
	     	var bestelling = AdminPanel.bestellingList.get(data.idbestelling);
	    	AdminPanel.bestellingList.remove(bestelling);
     	}
     });
  
    
//Document 
$(document).ready(function() {
	AdminPanel.start();
	$("#extra_kolom_btn").click(function(){
		AdminPanel.taxiList.create({
			Login: current_user_login+'_'+$('#nieuw_kolom').val(),
			fkUser: current_user_id,
			Naam: $('#nieuw_kolom').val()
		});
		$('#nieuw_kolom').val("");
	});

 });


 $("#settings").click(function() {
      $("#settings_modal").reveal();
 });
 
  $(".set").click(function() {
      $("#taxi_settings_modal").reveal();
 });
 
 
 function enable_drag(el){
 	el.draggable({
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
 }



//Backbone Options
Backbone.emulateHTTP = true
var current_user_id;
var current_user_login;
var channel_bedrijf;

//Gmaps
var map;
var map_model;
var geocoder = new google.maps.Geocoder();
var markerBounds = new google.maps.LatLngBounds();
var directionsDisplay;
//Models

var Bestelling = Backbone.Model.extend({
	setstatus: function(newstatus){
		this.set({
			'status': newstatus,
			'wachttijd': $('.wachttijd').val(),
		});
		this.save();
	}, 

	showmodal: function(){
	  var bestellingRevealView = new BestellingRevealView({model: this});
	  $('#checkmodal').reveal();
	  if(this.get('status') == 2){
	  	var template = 3;
	  }else{
	  	var template = 2;
	  }
	  if(this.get('status') == 5){
	  	template = 5;
	  }
	  $('#checkmodal .inforit').html(bestellingRevealView.render(template).el);
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
	url: 'api/taxi/',
});

var User = Backbone.Model.extend({
	url: 'admin/getuser',
	
	parse: function(data, options) {
		current_user_id = data.id;
		current_user_login = data.username;
		AdminPanel.taxiList.fetch( { data: { userid: data.id} });
		channel_bedrijf = pusher.subscribe('private-bedrijf_'+current_user_id);
	}
})


//Views
var BestellingView = Backbone.View.extend({
  template: Handlebars.compile(bestelling_tempalte),
  
  events: {
	  "click button" : "showmodule",
  },
  
  render: function(){
   if(!(this.model.get('status') == 1 && this.model.get('afgerond') == 1)){

	   	this.$el.html(this.template(this.model.toJSON()));
	   
	   	if(this.model.get('status') == 1){
	   		enable_drag(this.$el);
	   	}
		
	    if(this.model.get('status') == 3){
			this.$el.css('background-color', '#90BD3C');
			enable_drag(this.$el);
		}

		if(this.model.get('status') == 2){
			this.$el.css("background-color", "#FD4000");
			enable_drag(this.$el);
		}

		if(this.model.get('status') == 4){
			this.$el.find('.mark').hide();
			this.$el.css("background-color", "#F2A81D");
		}

		if(this.model.get('status') == 5){
			this.$el.find('.mark').hide();
			this.$el.css("opacity", "0.5");
		}
	    return this;
	}
  },
  
  showmodule: function(){
  	  this.model.showmodal();
  }
});

var BestellingRevealView = Backbone.View.extend({
	template1: Handlebars.compile(module_bestelling_template1),
	template2: Handlebars.compile(module_bestelling_template2),
	template3: Handlebars.compile(module_bestelling_template3),
	template5: Handlebars.compile(module_bestelling_template5),
	
	events: {
		"click .go" : "go",
		"click .cancel" : "cancel",
		"click .verwijder": "verwijder"
	},
	
	render: function(temp){
		if(temp == 1){
			this.$el.html(this.template1(this.model.toJSON()));
		}
		if(temp == 2){
			this.$el.html(this.template2(this.model.toJSON()));
		}
		if(temp == 3){
			this.$el.html(this.template3(this.model.toJSON()));
		}
		if(temp == 5){
			this.$el.html(this.template5(this.model.toJSON()));
		}

		return this;
	},
	
	go: function(){
		this.model.setstatus(2);
		$('#'+this.model.get('id')).css("background-color", "#FD4000");
		// $('#'+this.model.get('id')).remove();
		$('#checkmodal').trigger('reveal:close');
		// var bestellingView = new BestellingView({model: this.model});
		// $('#col'+this.model.get('status')+' ul').append(bestellingView.render(this.model.get('status')).el);
		console.log(this.model);
	},

	cancel: function(){
		$.post(base_url+'admin/cancelorderadmin/'+this.model.get('id')+'/'+current_user_id);
		$('#col1 ul').append($('#'+this.model.get('id')));	
		$('#'+this.model.get('id')).css('background-color', "");
		enable_drag($('#'+this.model.get('id')));
		this.$el.trigger('reveal:close');
	},

	verwijder: function(){
		$('#'+this.model.get('id')).remove();
		this.model.destroy();
		this.$el.trigger('reveal:close');
	}
});

var BestellingListView = Backbone.View.extend({
	initialize: function(){
		this.collection.on('add', this.addOne, this);
		this.collection.on('reset', this.addAll, this);
	},
	
	addOne: function(bestelling){
		console.log(bestelling);
		var bestellingView = new BestellingView({model: bestelling});
		// if(bestelling.get('taxi') == 0){
		// 	$('#col1 ul').prepend(bestellingView.render().el);
		// }else{
			if(bestelling.get('status') == 1 && bestelling.get('afgerond') == null){
			 	$('#col1 ul').prepend(bestellingView.render().el);
			 }

			if(bestelling.get('status') == 4){
				$('#taxi_'+bestelling.get('taxi')+' ul').find(".status4").before(bestellingView.render().el);
			}
			if(bestelling.get('status') == 2 || bestelling.get('status') == 3){
				$('#taxi_'+bestelling.get('taxi')+' ul').find(".status4").after(bestellingView.render().el);
			}
			if(bestelling.get('status') == 5){
				$('#taxi_'+bestelling.get('taxi')+' ul').find(".afgerond").after(bestellingView.render().el);
			}
		// }

	},
	
	addAll: function(){
		this.collection.forEach(this.addOne, this);
	},
	
	render: function(){
		this.addAll();
	}
});
 

var TaxiListView = Backbone.View.extend({
	initialize: function(){
		this.collection.on('add', this.addOne, this);
		this.collection.on('reset', this.addAll, this);
	},
	
	addOne: function(taxi){
		var taxiView = new TaxiView({model: taxi});
		$('.colmap').before(taxiView.render().el); 
	},
	
	addAll: function(){
		this.collection.forEach(this.addOne, this);
		AdminPanel.bestellingList.fetch();
	},
	
	render: function(){
		this.addAll();
	}

});

var TaxiView = Backbone.View.extend({
  className: "col",

  events: {
		"drop" : "dropped",
		"click .set": "settings"
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
      this.marker(this.model);
      if(this.model.get('Pauze') == 0){
      	this.$el.find("h1").css('border-right', "solid 4px rgb(144, 189, 60)");
      }else{
      	this.$el.find("h1").css('border-right', "solid 4px rgb(253, 64, 0)");
      }

      channeltaxi = pusher.subscribe('taxi_'+this.model.get('id'));
      channeltaxi.bind('taxi_pauze_'+this.model.get('id'), function(data) {
			if(data.Pauze == 0){
		      	$('#taxi_'+data.id).find("h1").css('border-right', "solid 4px rgb(144, 189, 60)");
		      }else{
		      	$('#taxi_'+data.id).find("h1").css('border-right', "solid 4px rgb(253, 64, 0)");
		      }
	    });
      $('#taxiselect').append('<option value="'+this.model.get("id")+'">'+this.model.get("Naam")+'</option>');
    return this;
  },

  dropped: function(event, ui){
  	var dragid = ui.draggable.find('li').attr('id');
  	var bestelling = AdminPanel.bestellingList.get(dragid);
  	if(bestelling.get('taxi') != this.model.get('id')){
	    this.$el.find('.ritten').find('.afgerond').before(ui.draggable);
	    var dragid = ui.draggable.find('li').attr('id');
	    var dragged = ui.draggable;  
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
  }, 

  marker : function(taxi){
  	 var myLatLng = new google.maps.LatLng(taxi.get('id'),4.483333);
     var marker = new google.maps.Marker( {position: myLatLng, map: map} );
     channel_bedrijf.bind('client-taxi_'+taxi.get('id'), function(data) {
            marker.setPosition( new google.maps.LatLng( data.lat, data.lang ) );                
     });
     marker.setIcon(base_url+'images/markers/number_'+taxi.get('id')+'.png');
  }, 

  settings: function(){
  	console.log(this.model);
  	var taxisettingsView = new TaxisettingsView({model: this.model});
	$('#taxi_settings_modal').reveal();
	$('#taxi_settings_modal').html(taxisettingsView.render().el);
  }
});

var TaxisettingsView = Backbone.View.extend({
	template: Handlebars.compile(taxi_settings),
	
	events: {
		"click #loguit" : "update",
		"click #delete" : "delete"
	},
	
	render: function(){
		this.$el.html(this.template(this.model.toJSON()));
		return this;
	},
	
	update: function(){
		this.model.set({
			'Naam': this.$el.find('input[name=naam]').val(),
			'pass': this.$el.find('input[name=pass]').val()
		});
		this.model.save();
		this.$el.trigger('reveal:close');
		$('#taxi_'+this.model.get('id')).find('h1').html(this.model.get('Naam'));
	},

	delete: function(){
		$('#taxi_'+this.model.get('id')).remove();
	    // AdminPanel.taxiList.remove(this.model);
	    this.model.destroy();
	    this.$el.trigger('reveal:close');
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
    Pusher.channel_auth_endpoint = base_url+'pusher/auth.php';

    var channel = pusher.subscribe('admin_all');

    channel.bind('taxi_bestelt', function(data) {
    	var newbestelling = new Bestelling(data);
    	AdminPanel.bestellingList.add(newbestelling);
    	//AdminPanel.bestellingList.fetch();
    });
    console.log('admin_'+$('#hiddenid').val());
    channel.bind('admin_'+$('#hiddenid').val(), function(data) {

  //   	$('#'+data).remove();
		var modelget = AdminPanel.bestellingList.get(data.id);
  //   	var bestellingView = new BestellingView({model: modelget});
		// $('#col3 ul').append(bestellingView.render(3).el);
		// col3drag();
		modelget.set({
		'status': data.Status,
		});
		console.log(modelget);
		if(data.Status == 3){
			$('#'+data.id).css('background-color', '#90BD3C');
		}

		if(data.Status == 4){
			$('#'+data.id).css('background-color', '#F2A81D');
			$('#taxi_'+modelget.get('taxi')+' ul').find(".status4").before($('#'+data.id));
			$('#'+data.id).find('button').click(function(){
				modelget.showmodal();
			});
		}

		if(data.Status == 5){
			$('#'+data.id).css('opacity', '0.5');
			$('#'+data.id).css('background', 'none');
			$('#taxi_'+modelget.get('taxi')+' ul').find(".afgerond").after($('#'+data.id));
			$('#'+data.id).find('button').click(function(){
				modelget.showmodal();
			});
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

	taximap();

	$('#taximap_click').toggle(function () {
     $('.sidebar').animate({right:"0px"}, 500); 
     $('#taximap_click img').css("background-color","rgba(225,225,225,0.75)");     
   },function () {
       $('.sidebar').animate({right: "-500px"}, 500); 
       $('#taximap_click img').css("background-color","inherit");     
    
	});

	$('#voegtoe').click(function(){
		var data = {
			naam: $('#settings_modal').find('input[name=Naam]').val(),
			tel: $('#settings_modal').find('input[name=Tel]').val(),
			adres1: $('#settings_modal').find('input[name=Adres1]').val(),
			adres2: $('#settings_modal').find('input[name=Adres2]').val(),
			tijd: $('#settings_modal').find('input[name=Tijd]').val(),
			taxi: $('#settings_modal').find('select').val(),
			fkUser: current_user_id,
			status: 3, 
			afgerond: 1,
		}
		$.ajax({
			type: 'POST',
			url: 'admin/bestellingtoevoegen',
			data: data,
			dataType: 'json',
			success: function(jsonData) {
				pauze = jsonData.pauze;
			  		data = {
			  			naam: $('#settings_modal').find('input[name=Naam]').val(),
						tel: $('#settings_modal').find('input[name=Tel]').val(),
						adres1: $('#settings_modal').find('input[name=Adres1]').val(),
						adres2: $('#settings_modal').find('input[name=Adres2]').val(),
						tijd: $('#settings_modal').find('input[name=Tijd]').val(),
						taxi: $('#settings_modal').find('select').val(),
						fkUser: current_user_id,
						status: 3, 
						afgerond: 1,
			  			id: jsonData.fkBestelling
			  		}
					var newbestelling = new Bestelling(data);
    				AdminPanel.bestellingList.add(newbestelling);
    				$('#settings_modal').trigger('reveal:close');

    				//$('#taxi_'+jsonData.fkTaxi+' ul').find(".status4").after(AdminPanel.bestellingView.render().el);
			 },
		});
	});	
 });


 $("#settings").click(function() {
      console.log('test');
      $('#timedate').datetimepicker({controlType: 'select'});

      var now = moment().format('DD/MM/YYYY HH:mm ');
      	
      $('#timedate').val(now); 

      $("#settings_modal").reveal();
 });
 


 //  $("#taximap_click").click(function() {
 //      $("#taximap").reveal();
 // });
 
 
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

 function taximap(){
 	var mapOptions = {
    	zoom: 13,
        center: new google.maps.LatLng(51.283333,4.483333),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
 }

 function new_taxi_map(taxi){

 }

 


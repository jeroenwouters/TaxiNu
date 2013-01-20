Handlebars.registerHelper('adresformat', function(passedString){
	var splitadres = passedString.split(',');
	var adres = splitadres[1];
	var geenpostcode = adres.replace(/[0-9]/g, '');
	return geenpostcode;
});
	  	
Handlebars.registerHelper('tijdformat', function(passedString){
	return passedString.substr(10, 6);
});
	  	
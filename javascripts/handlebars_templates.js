var bestelling_tempalte =
'<li class="rit" id="{{id}}"> \
	<img src="images/drag.png" class="mark" width="20px"> \
	<p class="vertrek"><b>Vertrek</b><br>{{adres1}}</p> \
	<p class="bestemming"><b>Bestemming</b><br>{{adres2}}</p> \
	<p class="uur">{{tijdformat tijd}}</p> \
	<p class="naamklant">{{naam}}</p> \
	<p class="telklant">{{tel}}</p> \
	<button class="thoughtbot check">Info</button> \
</li>';

var module_bestelling_template1 = 
'<p class="vertrek">{{adres1}}</p> \
<p class="bestemming">{{adres2}}</p> \
<div class="maps"></div> \
<p class="uur">{{tijd}}</p> \
<p class="naamklant">{{naam}}</p> \
<p class="telklant">{{tel}}</p> \
<p class="personen">{{personen}}</p> \
<p><input class="wachttijd"> minuten</p> \
<button class="go thoughtbot">Go!</button>';

var module_bestelling_template2 = 
'<p class="vertrek">{{adres1}}</p> \
<p class="bestemming">{{adres2}}</p> \
<div class="maps"></div> \
<p class="uur">{{tijd}}</p> \
<p class="naamklant">{{naam}}</p> \
<p class="telklant">{{tel}}</p> \
<p class="personen">{{personen}}</p>';

var module_bestelling_template3 = 
'<p class="vertrek">{{adres1}}</p> \
<p class="bestemming">{{adres2}}</p> \
<div class="maps"></div> \
<p class="uur">{{tijd}}</p> \
<p class="naamklant">{{naam}}</p> \
<p class="telklant">{{tel}}</p> \
<p class="personen">{{personen}}</p> \
<button class="thoughtbot check cancel">Annuleer bestelling</button>';

var module_bestelling_template5 = 
'<p class="vertrek">{{adres1}}</p> \
<p class="bestemming">{{adres2}}</p> \
<div class="maps"></div> \
<p class="uur">{{tijd}}</p> \
<p class="naamklant">{{naam}}</p> \
<p class="telklant">{{tel}}</p> \
<p class="personen">{{personen}}</p> \
<button class="thoughtbot check verwijder">Verwijder</button>';

var taxi_template = 
'<h1>{{Naam}}</h1> \
<div class="set"><img src="images/settings.png"></div> \
<ul class="ritten"> \
<li class="status4"></li> \
<li class="afgerond"></li> \
</ul>';

var rit_tempalte = 
'<p class="vertrek">{{adres1}}</p> \
<p class="bestemming">{{adres2}}</p> \
<p class="uur">{{tijdformat tijd}}</p> \
<p class="afstand">{{afstand}}</p> \
<p class="naamklant">{{naam}}</p>';

var rit_map_template = 
'<p><a id="passagier">Passagier</a></p> \
<p class="uur">{{tijdformat tijd}}</p> \
<p class="vertrek">{{adres1}}</p>\
<p class="bestemming">{{adres2}}</p> \
<img src="images/loc.png"/> \
<p id="afstandpos" class="afstand"></p> \
<img class="hail" src="images/hail_icon.png"/> \
<p class="afstand">{{afstand}}</p> \
<img src="images/finish.png"/> \
<div class="compleet_adres"> \
<p>{{adres1}}</p> \
<p>{{adres2}}</p> \
<p>{{naam}}</p> \
<p>{{tel}}</p> \
<p>{{personen}} Personen</p> \
</div>';

var taxi_settings = 
'<p class="lead">Taxi Naam</p> \
<input type="text" name="naam" placeholder="Taxi naam wijzigen" value="{{Naam}}" style="width:210px"> \
<p class="lead">Paswoord wijzigen</p> \
<input type="password" placeholder="nieuw paswoord" name="pass" value="" style="width:210px"> \
<a href="#"><button class="thoughtbot" id="loguit">Update</button></a> \
<a href="#" ><button style="margin-left:10px;"class="thoughtbot" id="delete">Delete</button></a> \
<a class="close-reveal-modal">&#215;</a>';'	'

var bestelling_tempalte =
'<li class="rit" id="{{id}}"> \
	<img src="images/drag.png" class="mark" width="20px"> \
	<p class="vertrek">{{adres1}}</p> \
	<p class="bestemming">{{adres2}}</p> \
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
'<p class="uur">{{tijdformat tijd}}</p> \
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
<p><a id="passagier">passagier</a></p></div>';


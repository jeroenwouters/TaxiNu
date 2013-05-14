var bestelling_tempalte =
'<li class="rit" id="{{id}}"> \
	<p class="vertrek">{{adresformat adres1}}</p> \
	<p class="bestemming">{{adresformat adres2}}</p> \
	<div class="maps"></div> \
	<p class="uur">{{tijdformat tijd}}</p> \
	<p class="naamklant">{{naam}}</p> \
	<p class="telklant">{{tel}}</p> \
	<button class="thoughtbot check">Info</button> \
</li>';

var bestelling_tempalte2 =
'<li class="rit" id="{{id}}"> \
	<img src="http://localhost:8888/taxinu/images/drag.png" class="mark" width="20px"> \
	<p class="vertrek">{{adresformat adres1}}</p> \
	<p class="bestemming">{{adresformat adres2}}</p> \
	<div class="maps"></div> \
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
'<h1>{{login}}</h1> \
<ul class="ritten"> \
</ul>';
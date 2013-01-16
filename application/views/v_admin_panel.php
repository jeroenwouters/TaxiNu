<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>Taxinu.be</title>
  
  <!-- Included CSS Files (Uncompressed) -->
  <!--
  <link rel="stylesheet" href="<?php echo base_url();?>stylesheets/foundation.css">
  -->
  
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="<?php echo base_url();?>stylesheets/foundation.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>stylesheets/app.css">
   <link rel="stylesheet/less" type="text/css" href="<?php echo base_url();?>stylesheets/admin.less">
   <link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css" />
    
  <script src="<?php echo base_url();?>javascripts/less.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>javascripts/modernizr.foundation.js"></script>

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>
<body>

	<header> 
		<img src="<?php echo base_url();?>images/logo.png" width="180px">
	</header>
	
		<div class="wrapper">
			<div class="col" id="col1">
				<h1>Active</h1>
				<ul class="ritten">	
					<li class="rit" id="1">
						<img src="<?php echo base_url();?>images/drag.png" class="mark" width="20px">
						<p class="vertrek">Kappelen</p>
						<p class="bestemming">Antwerpen</p>
						<div class="maps"></div> 
						<p class="uur">12:12</p>
						<p class="naamklant">Den Dannie</p>
						<p class="telklant">0475338844</p>
						<button class="thoughtbot check">Check</button>
					</li>
					<li class="rit" id="2">
						<img src="<?php echo base_url();?>images/drag.png" class="mark" width="20px">
						<p class="vertrek">Kalmthout</p>
						<p class="bestemming">Antwerpen</p>
						<div class="maps"></div> 
						<p class="uur">15:11</p>
						<p class="naamklant">Den Jhon</p>
						<p class="telklant">0475338844</p>
						<button class="thoughtbot check">Check</button>
					</li>
				</ul>
			</div>
			
			<div class="col" id="col2">
				<h1>Request</h1>
				<ul class="ritten">	
					<li class="rit" id="3">
						<img src="<?php echo base_url();?>images/drag.png" class="mark" width="20px">
						<p class="vertrek">Brasschaat </p>
						<p class="bestemming">Antwerpen</p>
						<div class="maps"></div> 
						<p class="uur">20:30</p>
						<p class="naamklant">Den Jhon</p>
						<p class="telklant">0475338844</p>
						<button class="thoughtbot check">Check</button>
					</li>
				</ul>
			</div>
			
			<div class="col" id="col3">
				<h1> Zone 03 </h1>
				<ul class="ritten">	
					<li class="rit" id="4">
						<img src="<?php echo base_url();?>images/drag.png" class="mark" width="20px">
						<p class="vertrek">Brasschaat </p>
						<p class="bestemming">Antwerpen</p>
						<div class="maps"></div> 
						<p class="uur">10:14</p>
						<p class="naamklant">Den Jhon</p>
						<p class="telklant">0475338844</p>
						<button class="thoughtbot check">Check</button>
					</li>
					<li class="rit" id="5">
						<img src="<?php echo base_url();?>images/drag.png" class="mark" width="20px">
						<p class="vertrek">Antwerpen</p>
						<p class="bestemming">Borgerhout</p>
						<div class="maps"></div> 
						<p class="uur">12:12</p>
						<p class="naamklant">Den Jhon</p>
						<p class="telklant">0475338844</p>
						<button class="thoughtbot check">Check</button>
					</li>
					<li class="rit" id="6">
						<img src="<?php echo base_url();?>images/drag.png" class="mark" width="20px">
						<p class="vertrek">Antwerpen</p>
						<p class="bestemming">Brussel</p>
						<div class="maps"></div> 
						<p class="uur">12:12</p>
						<p class="naamklant">Den Jhon</p>
						<p class="telklant">0475338844</p>
						<button class="thoughtbot check">Check</button>
					</li>
				</ul>

			</div>
			
			<div class="col" id="col4">
				<h1> Zone 04 </h1>
				<ul class="ritten">
				</ul>
			</div>
			
			<div class="col" id="col5">
				<h1> Zone 05 </h1>
				<ul class="ritten">
				</ul>
			</div>
		</div>
		
		<div id="checkmodal" class="reveal-modal large" style="background-color: black; color: white;">
			  <div class="mapsmodal"></div>
			  <p class="lead">Gegevens rit</p>
			  
			  <div class="labels">
			  			<p class="vertrek">Vertrek:</p>
						<p class="bestemming">Bestemming:</p>
						<p class="uur">Uur:</p>
						<p class="naamklant">Naam klant:</p>
						<p class="telklant">Telefoonnr.:</p>
						<p class="Personen">Personen:</p>
						<button class="thoughtbot">Go!</button>
			  </div>
			  
			  <div class="inforit">
			  
			  </div>
			  
			  
			  
			  
			  <a class="close-reveal-modal">&#215;</a>		
		</div>
  <!-- Included JS Files (Uncompressed) -->
  <!--
  
  <script src="javascripts/jquery.js"></script>
  
  <script src="javascripts/jquery.foundation.mediaQueryToggle.js"></script>
  
  <script src="javascripts/jquery.foundation.forms.js"></script>
  
  
  
  <script src="javascripts/jquery.foundation.orbit.js"></script>
  
  <script src="javascripts/jquery.foundation.navigation.js"></script>
  
  <script src="javascripts/jquery.foundation.buttons.js"></script>
  
  <script src="javascripts/jquery.foundation.tabs.js"></script>
  
  <script src="javascripts/jquery.foundation.tooltips.js"></script>
  
  <script src="javascripts/jquery.foundation.accordion.js"></script>
  
  <script src="javascripts/jquery.placeholder.js"></script>
  
  <script src="javascripts/jquery.foundation.alerts.js"></script>
  
  <script src="javascripts/jquery.foundation.topbar.js"></script>
  
  <script src="javascripts/jquery.foundation.joyride.js"></script>
  
  <script src="javascripts/jquery.foundation.clearing.js"></script>
  
  <script src="javascripts/jquery.foundation.magellan.js"></script>
  
  -->
  
  <!-- Included JS Files (Compressed) -->
   <script src="<?php echo base_url();?>javascripts/foundation.min.js"></script>
  <script src="<?php echo base_url();?>javascripts/app.js"></script>
  <script src="<?php echo base_url();?>javascripts/jquery.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/ui/1.9.1/jquery-ui.min.js"></script>
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.reveal.js"></script>
  <script src="<?php echo base_url();?>javascripts/timepicker.js"></script>
  <script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyBJGHEABxmLTzSTZ0HGDlmBMTuX1ktrsBc" type="text/javascript"></script>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
  <script src="<?php echo base_url();?>javascripts/user.js"></script>
  <!-- Initialize JS Plugins -->
  
   
</body>
</html>

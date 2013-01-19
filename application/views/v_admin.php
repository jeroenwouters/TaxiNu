
	<header> 
		<img src="<?php echo base_url();?>images/logo.png" width="180px">
		<div id="settings">
			<img src="<?php echo base_url();?>images/settings.png">
		</div>
		<div id="welkom">
				<p>Welkom --bedrijf--'s dispatcher</p>
		</div>	
		<div id="extra_kolom_btn">
			<p>+</p>
		</div>
		<div id="extra_kolom">
			<input type="text" id="nieuw_kolom" placeholder="Naam nieuwe kolom">
		</div>
		
		
		
	</header>
	
		<div class="wrapper">
			<div class="col" id="col1">
				<h1>Aanvragen</h1>
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
				<h1>In Wacht</h1>
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
				<h1>Bevestigd</h1>
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
				<h1>Taxi 1</h1>
				<ul class="ritten">
				</ul>
			</div>
			
			<div class="col" id="col5">
				<h1>Taxi 2 </h1>
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
		
		<div id="settings_modal" class="reveal-modal large" style="background-color: black; color: white;">
			  
			  <p class="lead">Instellingen</p>
			  
			 			  
			  
			  
			  
			  <a class="close-reveal-modal">&#215;</a>		
		</div>
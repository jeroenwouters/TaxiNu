
	<header> 
		<img src="<?php echo base_url();?>images/logo.png" width="180px">
		<div id="settings">
			<img src="<?php echo base_url();?>images/settings.png">
		</div>
		<div id="taximap_click">
			<img src="<?php echo base_url();?>images/pinmap.png">
		</div>
		<div id="welkom">
				<?php $sessiondata = $this->session->userdata('logged_in');?>
				<input id="hiddenid" hidden="" value="<?php echo $sessiondata['id'];?>"/>
				<p>Welkom <strong><?php echo $sessiondata['username'];?></strong></p>
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
				</ul>
			</div>	
			<div class="colmap"></div>
				<div class="sidebar">
					<div id="map-canvas" class="adminmap"></div>
				</div>

		</div>


		<div id="taximap" class="reveal-modal xlarge" style="background-color: black; color: white;"></div>

		<div id="checkmodal" class="reveal-modal xlarge" style="background-color: black; color: white;">
			  <div class="mapsmodal"></div>
			  <p class="lead">Gegevens rit</p>
			  
			  <div class="labels">
			  			<p class="vertrek">Vertrek:</p>
						<p class="bestemming">Bestemming:</p>
						<p class="uur">Uur:</p>
						<p class="naamklant">Naam klant:</p>
						<p class="telklant">Telefoonnr.:</p>
						<p class="Personen">Personen:</p>						
			  </div>
			  
			  <div class="inforit">
			  
			  </div>
			  
			  
			  
			  
			  <a class="close-reveal-modal">&#215;</a>		
		</div>
		
		<div id="settings_modal" class="reveal-modal small" style="background-color: black; color: white;">
			  
			  <p class="lead">Instellingen</p>
			  
			  <a href="<?php echo base_url();?>admin/logout"><button class="thoughtbot" id="loguit">Uitloggen</button></a>
			 			 
			  
			  <a class="close-reveal-modal">&#215;</a>		
		</div>
		
		<div id="taxi_settings_modal" class="reveal-modal large" style="background-color: black; color: white;">
			  
			  	
		</div>
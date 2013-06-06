<header>
		<div class="row user_panel">
			<div class="twelve columns">
				<ul>
					<li id="click_rit" class="active">Ritten</li>
					<li id="click_profile">Uw gegevens</li>
				</ul>

			</div>
		</div>

		<div class="row user_ritten">
		
				<div class="three columns rit_user">
					<p class="vertrek"> Brasschaat</p>
				 	<p class="bestemming"> Kapellen</p> 	
				 	<p class="uur">05/06/12 - 14:13</p> 	
				 	<p class="naamklant">Nick</p> 	
				 	<p class="telklant">475214440</p> 	
				 	<button class="thoughtbot check">Info</button>
				</div>	
				
		</div>

		<div class="row profile_user">
		
				<div class="twelve columns">
					<div class="profupdate">
					<form onsubmit="return false" id="update"> 
					  	<input type="text" name="NaamBox" placeholder="Naam">
					  	<input type="text" name="TelBox" placeholder="Telefoonnummer">
					  	<input type="text" name="EmailBox" placeholder="E-mail">
					    <input type="password" name="password" placeholder="Wachtwoord" >
					  	<button class="thoughtbot" type="submit" id="verder">Wijzigen</button>
					</form>
					<div style="clear:both;"></div>
					</div>
				</div>	
				
		</div>

		<div class="nav">
			 <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo.png" width="200px"></a>			
<!-- 			 <img class="question_btn" src="<?php echo base_url();?>images/question.png" width="35px"> 
 -->			 
 			 <div class="social">
							 	<div class="user_set"><img src="../images/settings.png"></div>
			 	
			 </div>
			 
		</div>
		
		<div class="info">
			<img src="<?php echo base_url();?>images/question.png">
			<ol>
				<li>Vul uw <span style="color:red;">vertreklocatie</span> in!</li>
				<li>Vul uw <span style="color:red">bestemming</span> in!</li>
				<li>Kies gewenste <span style="color:red">uur/dag</span>!</li>
			</ol>
		</div> 

		</header>
		
		
		<div class="row">
		    <div class="six columns ad">
		        <h1>Alleen maar voordelen!</h1>
		        <ul class="bullet">
		        	<li>Het is heel gemakkelijk!</li>
		        	<li>Meer dan 100 taxi bedrijven in ons bestand!</li>
		        	<li>Betaal contant of via PayPal!</li>
		        	<li>Geen extra kosten!</li>
		        	<li>Makkelijk locatie doorgeven.</li>
		        	<li>Altijd het snelst en goedkoopst</li>
		        </ul> 	
		    </div>
		    
		    <div class="six columns ad">	
		        <h1>Werkt op al uw apparaten!</h1><br />
		        <img src="<?php echo base_url();?>images/mobiles.png" width="350px" id="mobiles">
		    </div>
		</div>

		<div id="usersettings_modal" class="reveal-modal small" style="background-color: black; color: white;">
			  
			  <p class="lead">Instellingen</p>
			  
			  <a href="<?php echo base_url();?>admin/logout"><button class="thoughtbot" id="loguit">Uitloggen</button></a>
			 			 
			  
			  <a class="close-reveal-modal">&#215;</a>		
		</div>
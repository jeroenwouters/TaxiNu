<header id="userpanel">
		<div class="row user_panel">
			<div class="twelve columns">
				<ul>
					<li id="click_rit" class="active">Ritten</li>
					<li id="click_profile">Uw gegevens</li>
				</ul>

			</div>
		</div>
		<ul class="backslide hide-for-small">
            <li><span id="first" data-bg="<?php echo base_url();?>images/backtax.jpg">Image 01</span></li>
            <li><span>Image 02</span></li>   
            <li><span>Image 03</span></li>       
            <li><span>Image 04</span></li>       
        </ul>
		<div class="row user_ritten">
			<?php foreach ($query2->result() as $r2) { ?>
				<div class="three columns rit_user">
					<p class="vertrek"><b>Vertrek</b><br><?php echo $r2->Adres1;?></p>
				 	<p class="bestemming"><b>Bestemming</b><br><?php echo $r2->Adres2;?></p> 		
				 	<?php if($r2->Afgerond == 1 ){?>
				 		<p class="bedrijf"><br><?php echo $r2->Username;?></p> 	
				 		<p class="uur"><?php echo $r2->Tijd;?></p> 
				 		<?php foreach ($query3->result() as $r3) { ?>
				 			<?php if($r2->Status == 3){?>
						 		<a  href="<?php echo base_url();?>home/volgtaxi/<?php echo $r2->id;?>/<?php echo $r2->fkUser;?>" class="checkrit">Volg uw rit</a>
							<?php } ?>
						<?php } ?>
					<?php }else{ ?>
						 <a href="<?php echo base_url();?>home/aanvragen/<?php echo $r2->fkBestelling;?>" class="checkrit">Bekijk uw rit</a>
					<?php } ?>
				</div>	
			<?php } ?>	
		</div>

		<div class="row profile_user">
		
				<div class="twelve columns">
					<div class="profupdate">
					<form onsubmit="return false" id="update"> 
						<?php foreach ($query->result() as $r) { ?>
						  	<input type="text" name="NaamBox" placeholder="Naam" value="<?php echo $r->naam;?>">
						  	<input type="text" name="TelBox" placeholder="Telefoonnummer" value="<?php echo $r->tel;?>">
						  	<input type="text" name="EmailBox" placeholder="E-mail" value="<?php echo $r->email;?>">
						    <input type="password" name="password" placeholder="Wachtwoord">
						  	<button class="thoughtbot" type="submit" id="verder">Wijzigen</button>
					  	<?php } ?>
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
							 	<div class="user_set"><img src="<?php echo base_url();?>images/settings.png"></div>
			 	
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
	
		<header>
		<section class="topbar" id="animate">
				<ul class="bread">
			 	<li class="active"><img src="<?php echo base_url();?>images/1.png">Ritgegevens</li>
			 	<li><img src="<?php echo base_url();?>images/2.png">Uw Gegevens</li>
			 	<li><img src="<?php echo base_url();?>images/3.png">Bevestiging rit</li>
			 </ul>
		</section>  
		<div class="row">
		
			<div class="twelve colums">
				<div class="search">
				<img src="<?php echo base_url();?>images/logo.png" width="250px" id="logophone">
				<p id="titel">Snel een taxi zonder zorgen.</p>
				<?php 
				if($this->session->flashdata('val_home')){
					$flashdata_val_home = $this->session->flashdata('val_home');	
				}
				?>
				<?php echo form_open('home/detail');?>
				
				<input name="adres1" type="text" value="<?php if(isset($flashdata_val_home)){ echo $flashdata_val_home['adres1'];}?>" placeholder="Vertrek" id="address1">
				<div id="location">
					
				</div>
				<input name="adres2" type="text" value="<?php if(isset($flashdata_val_home)){ echo $flashdata_val_home['adres2'];}?>" placeholder="Bestemming" id="address2">
				<input name="tijd" type="datetime" value="<?php if(isset($flashdata_val_home)){ echo $flashdata_val_home['tijd'];}?>" placeholder="12 December 12:12" id="timedate" class="timephone">
				<button class="thoughtbot" type="submit">Bestel Taxi!</button>
				<?php echo form_close();?>
				<div class="errors">
					<?php if(isset($flashdata_val_home)){ echo $flashdata_val_home['error'];}  ?>
				</div>
				</div>
			</div>
			
		</div>   
		<div class="nav">
			 <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo.png" width="200px"></a>			
<!-- 			 <img class="question_btn" src="<?php echo base_url();?>images/question.png" width="35px"> 
 -->			 
			 <div class="social">
			 	<div class="set"><a href="admin"><img src="images/settings.png"></a></div>
			 	
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
	

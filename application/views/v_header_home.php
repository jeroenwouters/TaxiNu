	
		<header class="homehead">
		<div class="nav">
			 <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo.png" width="200px"></a>			
<!-- 			 <img class="question_btn" src="<?php echo base_url();?>images/question.png" width="35px"> 
 -->			 
			 <div class="social">
			 	<div class="set"><a href="admin"><img src="<?php echo base_url();?>images/settings.png"></a></div>
			 	
			 </div>
		</div>
		<ul class="backslide hide-for-small">
            <li><span>Image 01</span></li>
            <li><span>Image 02</span></li>   
            <li><span>Image 03</span></li>       
            <li><span>Image 04</span></li>       
        </ul>
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
<!-- 				<img src="<?php echo base_url();?>images/logo.png" width="250px" id="logophone">
 -->				<p id="titel">Snel een taxi zonder zorgen.</p>
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

		</header>
		
		
		<div class="row" style="z-index: 10">
		    <div class="six columns ad">
		        <h1>Alleen maar voordelen!</h1>
		        <ul class="bullet">
		        	<li>Het is heel gemakkelijk</li>
		        	<li>Niet meer bellen</li>
		        	<li>Volg je taxi tot op/aan de voet</li>
		        	<li>Geen extra kosten</li>
		        	<li>Makkelijk locatie doorgeven</li>
		        	<li>Altijd het snelst</li>
		        </ul> 	
		    </div>
		    
		    <div class="six columns ad up">	
		        <h1>Werkt op al uw apparaten!</h1><br />
		        <img src="<?php echo base_url();?>images/mobiles.png" width="350px" id="mobiles">
		    </div>
		</div>
		
		<div id="homemap" style="z-index: 10">

    	</div>

		<div class="row hide-for-small" style="z-index: 10">
		    <div class="twelve columns">
		        <h1 style="text-align:center">Dit is Taxinu.be!</h1>
				<div class="videoWrapper">
				<iframe src="http://player.vimeo.com/video/68214021?title=0&amp;byline=0&amp;portrait=0&amp;color=eb0509" width="400" height="225" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
				</div>
		</div>

		
	

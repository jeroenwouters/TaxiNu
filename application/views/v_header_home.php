
		<header>
		   
		<div class="row">
		
			<div class="twelve colums">
				<div class="search">
				<p id="titel">Snel een taxi zonder zorgen.</p>
				<?php echo form_open('home/detail');?>
				<input name="adres1" type="text" placeholder="Vertrek" id="address1">
				<input name="adres2" type="text" placeholder="Bestemming" id="address2">
				<input name="tijd" type="text" placeholder="12 December 12:12" id="timedate">
				<button class="thoughtbot" type="submit">Taxi!</button>
				<?php echo form_close();?>
				</div>
			</div>
			
		</div>   
		<div class="nav">
			 <img src="<?php echo base_url();?>images/logo.png" width="200px">
			 <div class="social">
			 	<img src="<?php echo base_url();?>images/f.png" width="15px;">
			 	<img src="<?php echo base_url();?>images/t.png" width="50px;">
			 	<img src="<?php echo base_url();?>images/p.png" width="25px;">
			 	
			 </div>
		</div>
		    
		</header>

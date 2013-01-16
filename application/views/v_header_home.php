	
		<header>
		   
		<div class="row">
		
			<div class="twelve colums">
				<div class="search">
				<p id="titel">Snel een taxi zonder zorgen.</p>
				<?php 
				if($this->session->flashdata('val_home')){
					$flashdata_val_home = $this->session->flashdata('val_home');	
				}
				?>
				<?php echo form_open('home/detail');?>
				<input name="adres1" type="text" value="<?php if(isset($flashdata_val_home)){ echo $flashdata_val_home['adres1'];}?>" placeholder="Vertrek" id="address1">
				<input name="adres2" type="text" value="<?php if(isset($flashdata_val_home)){ echo $flashdata_val_home['adres2'];}?>" placeholder="Bestemming" id="address2">
				<input name="tijd" type="text" value="<?php if(isset($flashdata_val_home)){ echo $flashdata_val_home['tijd'];}?>" placeholder="12 December 12:12" id="timedate">
				<button class="thoughtbot" type="submit">Taxi!</button>
				<?php echo form_close();?>
				<div class="errors">
					<?php if(isset($flashdata_val_home)){ echo $flashdata_val_home['error'];}  ?>
				</div>
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


 		<header>
		<div class="row">
			<div class="five columns">
				<div id="map_canvas" class="maps">
					
				</div>
			</div>
			
			<div class="seven columns">
				<div class="errors" id="line">
						<?php echo validation_errors();?>
					</div>
				<div class="detail">
					<?php echo form_open('home/besteltaxi/');?>
					<input name="adres1" type="text" value="<?php echo $_POST['adres1'];?>" placeholder="Brasschaat" id="address1">
					<input name="adres2" type="text" value="<?php echo $_POST['adres2'];?>" placeholder="Antwerpen Centrum" id="address2">
					<input name="tijd" type="text" value="<?php echo $_POST['tijd'];?>" placeholder="12 December 12:12" id="timedate">
					<input name="personen" type="text" placeholder="Hoeveel personen?">
					 <input type="hidden" name="naam">
					 <input type="hidden" name="tel">
					 <input type="hidden" name="email">
					<button type="submit" class="thoughtbot nonactive" id="order" disabled="disabled">Bevestigen.</button>
					<?php echo form_close();?>
					<button class="thoughtbot" id="help">Login</button>
				
				</div>
			</div>
			
			
			
		</div>   
		<div class="nav">
			 <a href="index.html"><img src="<?php echo base_url();?>images/logo.png" width="200px"></a>
			 <div class="social">
			 	<img src="<?php echo base_url();?>images/f.png" width="15px;">
			 	<img src="<?php echo base_url();?>images/t.png" width="50px;">
			 	<img src="<?php echo base_url();?>images/p.png" width="25px;">
			 	
			 </div>
		</div>
		    
		</header>
	
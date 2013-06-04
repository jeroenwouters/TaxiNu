
 		<header>
		<section class="topbar" style="top:0px">
				<ul class="bread" style="display:block">
			 	<li><img src="<?php echo base_url();?>images/1.png">Ritgegevens</li>
			 	<li class="active"><img src="<?php echo base_url();?>images/2.png">Uw Gegevens</li>
			 	<li><img src="<?php echo base_url();?>images/3.png">Bevestiging rit</li>
			 </ul>
			 </ul>
		</section>  
		<div class="row">
			<div class="five columns hide-for-small">
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
					 <input type="hidden" name="Afstand">
					<button type="submit" class="thoughtbot" id="order">Taxi bestellen</button>
					<?php echo form_close();?>
					<button class="thoughtbot" id="help">Bevestigen</button>
				
				</div>
			</div>
			
			
			
		</div>   
		<div class="nav">
			 <a href="index.html"><img src="<?php echo base_url();?>images/logo.png" width="200px"></a>
			 
			 

			 <div class="social">
			 	<div class="set"><a href="../admin"><img src="../images/settings.png"></a></div>
			 	
			 </div>
		</div>
		    
		</header>
	
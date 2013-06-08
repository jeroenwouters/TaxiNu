
<header id="pending">
		   
		   <section class="topbar" style="top:0px">
				<ul class="bread" style="display:block">
			 	<li><img src="<?php echo base_url();?>images/1.png">Ritgegevens</li>
			 	<li><img src="<?php echo base_url();?>images/2.png">Uw Gegevens</li>
			 	<li class="active"><img src="<?php echo base_url();?>images/3.png">Bevestiging rit</li>
			 </ul>
			 </ul>
		</section>  
		<div class="row">
		
			<div class="twelve columns">
				<div id="loading">
					<h4>Uw aanvraag is verstuurd. Wachten op antwoord taxibedrijven.</h4>
					<div id="loader">
					<img src="<?php echo base_url();?>images/loader.gif">
					</div>
					
					<input type="hidden" id="hiddenid" name="id" value="<?php echo $id;?>"/>
					<section class="toaccept">
					<ul id="bedrijven">
						<?php foreach($query->result() as $r){?>
							<li>
								<p><?php echo $r->Username;?></p>
								<p>Wachttijd: <span class="minutes"><?php echo $r->Wachttijd;?></span> min.</p>
								<a href="<?php echo base_url();?>home/bevestig/<?php echo $r->fkBestelling;?>/<?php echo $r->fkUser;?>">
								<button class="thoughtbot">Bevestig</button>
							</li>
						<?php } ?>
					</ul>
					</section>
				<br>
				<br>
				</div>
			</div>
		</div>

<div class="nav">
			 <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo.png" width="200px"></a>			
			
			 

			 <div class="social">
			 	<div class="set"><a href="../admin"><img src="../images/settings.png"></a></div>
			 	
			 </div>
		</div>

</header>
<script type="text/javascript">
	var bestelling_id = "<?php echo $this->uri->segment(3);?>";
</script>
<script src="http://js.pusher.com/1.12/pusher.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>javascripts/jquery.js"></script>
<script src="<?php echo base_url();?>javascripts/pusher_client.js"></script>
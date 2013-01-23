
<header id="pending">
		   
		<div class="row">
		
			<div class="twelve columns">
				<div id="loading">
					<h4>Uw aanvraag is verstuurd. Wachten op antwoord taxibedrijven.</h4>
					<div id="loader">
					<img src="<?php echo base_url();?>images/loader.gif">
					</div>
					<input type="hidden" id="hiddenid" name="id" value="<?php echo $id;?>"/>
					<h3>Bevestigd</h3>
					<ul id="bedrijven">
						
					</ul>
				<br>
				<br>
				</div>
			</div>
		</div>
		
</header>
	
<script src="http://js.pusher.com/1.12/pusher.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>javascripts/jquery.js"></script>
<script src="<?php echo base_url();?>javascripts/pusher_client.js"></script>
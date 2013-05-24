
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

<div class="nav">
			 <img src="<?php echo base_url();?>images/logo.png" width="200px">			
			 <img class="question_btn" src="<?php echo base_url();?>images/question.png" width="35px"> 
			
			 <ul class="bread" style="display:block;">
			 	<li ><img src="<?php echo base_url();?>images/1.png">Ritgegevens</li>
			 	<li><img src="<?php echo base_url();?>images/2.png">Uw Gegevens</li>
			 	<li class="active"><img src="<?php echo base_url();?>images/3.png">Bevestiging rit</li>
			 </ul>

			 <div class="social">
			 	<img src="<?php echo base_url();?>images/f.png" width="15px;">
			 	<img src="<?php echo base_url();?>images/t.png" width="50px;">
			 	<img src="<?php echo base_url();?>images/p.png" width="25px;">
			 	
			 </div>
		</div>

</header>
	
<script src="http://js.pusher.com/1.12/pusher.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>javascripts/jquery.js"></script>
<script src="<?php echo base_url();?>javascripts/pusher_client.js"></script>
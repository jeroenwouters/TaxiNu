<!DOCTYPE html>
<meta charset="UTF-8">

<head>
	<title>Admin TaxiNu</title>
	<link rel="stylesheet" href="<?php echo base_url();?>stylesheets/foundation.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>stylesheets/app.css">
   <link rel="stylesheet/less" type="text/css" href="<?php echo base_url();?>stylesheets/styles.less">
   <link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css" />
    
  <script src="<?php echo base_url();?>javascripts/less.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>javascripts/modernizr.foundation.js"></script>

</head>
<body>
<header>
		   
		<div class="row">
		
			<div class="twelve colums">
				
				<div id="loading">
					<h3>Uw aanvraag is verstuurd. Wachten op antwoord taxibedrijf.</h3>
					<div id="loader">
					<img src="<?php echo base_url();?>images/loader.gif">
					</div>
					<input type="hidden" id="hiddenid" name="id" value="<?php echo $id;?>"/>
					<h3>Bevestigd</h3>
					<ul id="bedrijven">
						<li>
							<p>DTM TAXI</p>
							<p>Wachttijd: <span class="minutes">10</span> min.</p>
							<button class="thoughtbot">Bevestig</button>
						</li>
						<li>
							<p>Antwerp TAXI</p>
							<p>Wachttijd: <span class="minutes">15</span> min.</p>
							<button class="thoughtbot">Bevestig</button>
						</li>
					</ul>
				<br>
				<br>
				<table id="taxibestellingen" style="clear: left;">
					<tr>
						<th>Bedrijven</th>
						<th>Bevestig</th>
					</tr>
				</table>
				</div>
			</div>
		</div>
		<div class="nav">
			 <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo.png" width="200px"></a>			 <div class="social">
			 	<img src="<?php echo base_url();?>images/f.png" width="15px;">
			 	<img src="<?php echo base_url();?>images/t.png" width="50px;">
			 	<img src="<?php echo base_url();?>images/p.png" width="25px;">
			 	
			 </div>
		</div>
</header>
	
		 <script src="http://js.pusher.com/1.12/pusher.min.js" type="text/javascript"></script>
	 <script src="<?php echo base_url();?>javascripts/jquery.js"></script>
	 <script src="<?php echo base_url();?>javascripts/pusher_client.js"></script>
</body>
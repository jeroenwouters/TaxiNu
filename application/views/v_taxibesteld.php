	<!DOCTYPE html>
<meta charset="UTF-8">

<head>
	<title>Admin TaxiNu</title>
	<link rel="stylesheet" href="<?php echo base_url();?>stylesheets/foundation.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>stylesheets/app.css">
   <link rel="stylesheet/less" type="text/css" href="<?php echo base_url();?>stylesheets/styles.less">
   <link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">   
    
  <script src="<?php echo base_url();?>javascripts/less.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>javascripts/modernizr.foundation.js"></script>
  
</head>
<body>
<header id="pending">
		   
		<div class="row">
		
			<div class="twelve colums">
				
				<div id="loading">
					<h3>Uw taxi is besteld en onderweg.</h3>
				<br>
				<br>
				</div>
			</div>
		</div>
		
</header>
	
	 <script src="http://js.pusher.com/1.12/pusher.min.js" type="text/javascript"></script>
	 <script src="<?php echo base_url();?>javascripts/jquery.js"></script>
	 <script src="<?php echo base_url();?>javascripts/pusher_client.js"></script>
	 <script src="<?php echo base_url();?>javascripts/foundation.min.js"></script>
	 <script src="<?php echo base_url();?>javascripts/app.js"></script>
	 <script type="text/javascript" src="http://code.jquery.com/ui/1.9.1/jquery-ui.min.js"></script>
	 <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js"></script><script src="<?php echo base_url();?>javascripts/timepicker.js"></script>
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.reveal.js"></script>
  <?php if($this->uri->segment(2) == 'detail'){?>
  	<script src="<?php echo base_url();?>javascripts/maps.js"></script>
  <?php } ?>
  <script src="<?php echo base_url();?>javascripts/enquire.js"></script>
  <script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyBJGHEABxmLTzSTZ0HGDlmBMTuX1ktrsBc" type="text/javascript"></script>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
  <script src="<?php echo base_url();?>javascripts/user.js"></script>
</body>
<!DOCTYPE html>
<meta charset="UTF-8">

<head>
	<title>Admin TaxiNu</title>
	 <script src="http://js.pusher.com/1.12/pusher.min.js" type="text/javascript"></script>
	 <script src="<?php echo base_url();?>javascripts/jquery.js"></script>
	 <script src="<?php echo base_url();?>javascripts/pusher_admin.js"></script>
</head>
<body>
	<?php  $session_data = $this->session->userdata('logged_in'); ?>
	Welkom,<strong> <?php echo $session_data['username'];?></strong></br></br>
	<table id="taxibestellingen">
		<tr>
			<th>Van</th>
			<th>Naar</th>
			<th>Wanneer</th>
			<th>Personen</th>
			<th>Bevestig</th>
		</tr>
	</table>
	<a href="<?php echo base_url();?>index.php/admin/logout">loguit</a>
</body>
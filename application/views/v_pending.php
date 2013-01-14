<!DOCTYPE html>
<meta charset="UTF-8">

<head>
	<title>Admin TaxiNu</title>

</head>
<body>
	<input type="hidden" id="hiddenid" name="id" value="<?php echo $id;?>"/>
	<table id="taxibestellingen">
		<tr>
			<th>Berijven</th>
			<th>Bevestig</th>
		</tr>
	</table>
	
		 <script src="http://js.pusher.com/1.12/pusher.min.js" type="text/javascript"></script>
	 <script src="<?php echo base_url();?>javascripts/jquery.js"></script>
	 <script src="<?php echo base_url();?>javascripts/pusher_client.js"></script>
</body>
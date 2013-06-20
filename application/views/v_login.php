<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=0.9, maximum-scale=0.9, user-scalable=no">   

<head>
	<title>Admin TaxiNu</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>stylesheets/admin_login/style.css" />

</head>
<body>


	
	
	<section class="main">	
		
		<div class="logo">
			<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo.png" width="300px"></a>
			<h3>Welkom, gelieve in te loggen!</h3>
		</div>
		
		<?php echo form_open('admin/login');?>
		
		<p class="field">
			<input type="text" name="user"  id="login" placeholder="Username">
			<i class="icon-user icon-large"></i>
		</p>
		
		<p class="field">
			<input type="password" id="password" name="pass" placeholder="Password">
			<i class="icon-lock icon-large"></i>
		</p>	
		
		<p class="submit">
			<button  type="submit" name="commit" ><i class="icon-arrow-right icon-large"></i></button>
		</p>
		<?php echo form_close();?>	
		
		<section class="logininfo">
			<h3>Deze gebruikers met account kunnen inloggen:</h3>
			<ul>
				<li>Taxiklanten</li>
				<li>Taxichauffeurs</li>
				<li>Taxibedrijven</li>
			</ul>
		</section>

	</section>

	
	


</body>






</form>
</section>
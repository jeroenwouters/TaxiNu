<!DOCTYPE html>
<meta charset="UTF-8">

<head>
	<title>Admin TaxiNu</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>stylesheets/admin_login/style.css" />

</head>
<body>


			
			
		<section class="main">	
		
		<div class="logo">
			<img src="<?php echo base_url();?>images/logo.png" width="300px" >	
			<h3>Admin Login</h3>
		</div>
			
			<?php echo form_open('admin/login');?>
		
		<p class="field">
						<input type="text" name="user"  id="login" placeholder="Username or email">
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
		</section>
				


</body>



					
						
					
				</form>
</section>
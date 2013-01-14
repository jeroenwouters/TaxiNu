<!DOCTYPE html>
<meta charset="UTF-8">

<head>
	<title>Admin TaxiNu</title>
</head>
<body>
	<?php echo form_open('admin/login');?>
		Username: <input type="text" name="user"/></br>
		Pass: <input type="password" name="pass"/>
		<button type="submit">Login!</button>
	<?php echo form_close();?>
</body>

	<header> 
		<a id="simple-menu" href="#sidr"><img id="set" class="icon lefticon" id="world" src="<?php echo base_url();?>images/list.png"></a>
		<img id="list" class="icon lefticon" id="world" src="<?php echo base_url();?>images/set.png">
		<img id="logo" src="<?php echo base_url();?>images/logo.png" width="180px">
		<img id="world" class="icon righticon"  src="<?php echo base_url();?>images/world.png">	
		<img id="loc" class="icon righticon"  src="<?php echo base_url();?>images/loc.png">	
	</header>
	
	<div id="sidr">
  <!-- Your content -->
  <ul>
    <li><a href="<?php echo base_url();?>admin/logout">Uitloggen</a></li>
    <li class="active"><a href="#">In pauze gaan</a></li>
  </ul>
</div>

	
	<div id="lijst" class="wrapper">
			<ul class="ritten">
				<li class="status4"></li> 
				<li class="afgerond"></li>
			</ul>
	</div>
	<div class="wrapper" id="map">
		
	</div>
	<div id="maprit">
	</div>

	<div id="settings_modal" class="reveal-modal small" style="background-color: black; color: white;">		  
			  <p class="lead">Instellingen</p>		   		  
			  <a href="<?php echo base_url();?>admin/logout"><button class="thoughtbot" id="loguit">Uitloggen</button></a>
			  <a href="#"><button class="thoughtbot" id="loguit">Pauze</button></a> 		  
			  <a class="close-reveal-modal">&#215;</a>		
	</div>
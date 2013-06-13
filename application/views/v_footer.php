
		<footer>
		    <div class="row">
		        <div class="four columns">
		        	<h1 style="margin-left:0px">Contacteer ons</h1>
              <!-- <form id="contact">
                  <input type="text" placeholder="Naam"></input>
                  <input type="text" placeholder="Email"></input>
                  <input type="text" placeholder="Bericht" style="height: 60px"></input>
                  <button class="contact_btn">Verzenden</button>
              -->
		        </div>
		        <div class="four columns">
                  <img class="logo_footer"src="<?php echo base_url();?>images/logo.png" width="250px">		        </div>
		        <div class="four columns">
		        <h1 style="margin-left:0px">Over Taxinu.be</h1>
            <p style="margin-bottom: 0px;">Taxinu is een online webplatform dat zowel de taxigebruiker als de taxibedrijven in staat stelt om eenvoudig taxi's te bestellen of om te laten bestellen. <br><br><br><br> Webdesign/development:<br>
            <a href="#" class="we">Jeroen Wouters</a> - <a href="#" class="we">Nick Van Walleghem</a></span></p>
		        </div>
		    </div>
		</footer>  
 <div id="loginhelp" class="reveal-modal small" style="background-color: black; color: white; top: 100px; opacity: 1; visibility: hidden; display: none;">
    <div class="loginerror">
      <p>Opgegeven login combinatie is niet correct!</p> 
    </div>
    Bent u een <p id="userswitch">bestaande klant</p>?
    <br><br>
  <div class="switch" style="display: none">
  <form onsubmit="return false" id="login"> 
    <input type="text" name="loginemail" placeholder="E-mail">
    <input type="password" name="loginpass" placeholder="Wachtwoord">
    <button class="thoughtbot" id="loginbtn">Inloggen</button>
  </form>
</div>
  <div class="switch">
  <form onsubmit="return false" id="form1"> 
  	<input type="text" name="NaamBox" placeholder="Naam">
  	<input type="text" name="TelBox" placeholder="Telefoonnummer">
  	<input type="text" name="EmailBox" placeholder="E-mail">
    <input type="password" name="password" placeholder="Wachtwoord" >
  	<button class="thoughtbot" type="submit" id="verder">Registreer</button>
  </form>
</div>
  <a class="close-reveal-modal">×</a>
</div>
<div class="reveal-modal-bg" style="opacity: 0.8; display: none; cursor: pointer;"></div>
  <!-- Included JS Files (Uncompressed) -->
  <!--
  
  <script src="<?php echo base_url();?>javascripts/jquery.js"></script>
  
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.mediaQueryToggle.js"></script>
  
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.forms.js"></script>
  

  
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.orbit.js"></script>
  
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.navigation.js"></script>
  
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.buttons.js"></script>
  
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.tabs.js"></script>
  
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.tooltips.js"></script>
  
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.accordion.js"></script>
  
  <script src="<?php echo base_url();?>javascripts/jquery.placeholder.js"></script>
  
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.alerts.js"></script>
  
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.topbar.js"></script>
  
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.joyride.js"></script>
  
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.clearing.js"></script>
  
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.magellan.js"></script>
  
  -->
  
  <!-- Included JS Files (Compressed) -->
   <script src="<?php echo base_url();?>javascripts/foundation.min.js"></script>
  <script src="<?php echo base_url();?>javascripts/app.js"></script>

  <script>
  $(document).ready(function(){
	  	    $('#order').hide(); 

  });

  var base_url = "<?php echo base_url();?>";
  </script>
  <script type="text/javascript" src="http://code.jquery.com/ui/1.9.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js"></script>
  <script src="<?php echo base_url();?>javascripts/timepicker.js"></script>
  <script src="<?php echo base_url();?>javascripts/jquery.foundation.reveal.js"></script>
   
   <?php if($this->uri->segment(2) == ''){?>   
<script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyBJGHEABxmLTzSTZ0HGDlmBMTuX1ktrsBc" type="text/javascript"></script>
    <script>
    $(document).ready(function() {

    var mapOptions = {
                  zoom: 13,
                    center: new google.maps.LatLng(51.283333,4.483333),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scrollwheel: false,
                  }
    var map = new google.maps.Map(document.getElementById('homemap'),mapOptions);
    var myLatLng = new google.maps.LatLng(51.283333,4.483333);
    var marker = new google.maps.Marker( {position: myLatLng, map: map} );
    });
  </script>
<?php } ?>

  <?php if($this->uri->segment(2) == 'detail'){?>
  <script src="<?php echo base_url();?>javascripts/maps.js"></script>
  <script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyBJGHEABxmLTzSTZ0HGDlmBMTuX1ktrsBc" type="text/javascript"></script>
  <?php } ?>
  <script src="<?php echo base_url();?>javascripts/enquire.js"></script>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
  <script src="<?php echo base_url();?>javascripts/moment.min.js"></script>
  <script src="<?php echo base_url();?>javascripts/jQueryRotateCompressed.2.2.js"></script>
  <?php if($this->uri->segment(2) == 'volgtaxi'){?>
    <script type="text/javascript">
      var taxi = <?php echo $taxi;?>;
      var bedrijf = <?php echo $this->uri->segment(4);?>;
    </script>
    <script src="http://js.pusher.com/1.12/pusher.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>javascripts/maps_bevestig.js"></script>
  <?php } else{ ?>
    
    <script src="<?php echo base_url();?>javascripts/user.js"></script>
  <?php } ?>

  
  
 
  
  <!-- Initialize JS Plugins -->
  
  
  
</body>
</html>

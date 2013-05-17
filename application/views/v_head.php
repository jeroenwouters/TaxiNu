<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">   

  <title>Taxinu.be</title>
  
  <!-- Included CSS Files (Uncompressed) -->
  <!--
  <link rel="stylesheet" href="stylesheets/foundation.css">
  -->
  
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="<?php echo base_url();?>stylesheets/foundation.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>stylesheets/app.css">
   <link rel="stylesheet/less" type="text/css" href="<?php echo base_url();?>stylesheets/styles.less">
   <link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css" />
   <meta name="viewport" content="user-scalable=yes">
   
  <script src="<?php echo base_url();?>javascripts/jquery.js"></script>

  <script src="<?php echo base_url();?>javascripts/less.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>javascripts/modernizr.foundation.js"></script>

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
<style>
 	#order{
	 	display: none;
 	}
	
	header{
	position: relative;
	background-image: url(http://www.taxinu.be/images/straat2.jpg);
	background-repeat: no-repeat;
	background-size: cover;}
</style>



</head>
<body>
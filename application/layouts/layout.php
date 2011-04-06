<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Blueprint Sample Page</title>

    <!-- Framework CSS -->
    <link rel="stylesheet" href="/styles/blueprint/screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="/styles/blueprint/print.css" type="text/css" media="print">
    <!--[if lt IE 8]><link rel="stylesheet" href="/styles/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->

    <!-- Import fancy-type plugin for the sample page. -->
    <link rel="stylesheet" href="/styles/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
  </head>
  <body>
    <div class="container">      
      <?php 
      	include ("parts/header.php");
      ?>
      <div class="span-7 colborder">
      <?php 
      	include ("parts/column1.php");
      ?>
      </div>
      <div class="span-8 colborder">        
      	<?php 
      		include ("parts/column2.php");
      	?>
      </div>
      <div class="span-7 last">
     	<?php 
     		echo $column3;
      		//include ("parts/column3.php");
      	?>        
      </div>
      <hr>
      <hr class="space">
      <div class="span-15 prepend-1 colborder">
      	<?php 
      		include ("parts/content.php");
      	?>        
      </div>
      <div class="span-7 last">
      	<?php 
      		include ("parts/menu.php");
      	?>        
      </div>
      	<?php 
      		include ("parts/footer.php");
      	?>      
    </div>
  </body>
</html>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head> </head>

<body>
	<?php  
		echo 'The term you searched for : ' .(implode(", ",$Terms));
	?>
	<br><br>
	<a href="http://twitterdata.brotskydesigns.com/td/rockmongo/index.php"> Check the DataBase </a>

	<div>
  		<form action= <?php
								$this->load->helper('url');
								echo site_url("frontend_controller/goto_search");
								?> method="post">
    		<input type="submit" class="btn btn-primary" value = "View a report">
  		</form> 
	</div>
</body>
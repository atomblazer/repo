<!doctype html public "✰">
<html lang="en-us" class="no-js">

<head>
	<meta charset="utf-8">

	<title>TweetData Login</title>

	<?php
	$this->load->helper('html');
	$this->load->helper('utility_helper');
	$this->load->library('javascript');
	?>

	<link rel="stylesheet" href="<?php echo base_url(); ?>styles/adminica/reset.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700">

	<link rel="stylesheet" href="<?php echo base_url(); ?>styles/plugins/all/plugins.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>styles/adminica/all.css">

	<link rel="stylesheet" href="<?php echo base_url(); ?>styles/themes/layout_switcher.php?default=layout_fixed.css" >
	<link rel="stylesheet" href="<?php echo base_url(); ?>styles/themes/nav_switcher.php?default=nav_top.css" >
	<link rel="stylesheet" href="<?php echo base_url(); ?>styles/themes/skin_switcher.php?default=switcher.css" >
	<link rel="stylesheet" href="<?php echo base_url(); ?>styles/themes/theme_switcher.php?default=theme_blue.css" >
	<link rel="stylesheet" href="<?php echo base_url(); ?>styles/themes/bg_switcher.php?default=bg_honeycomb.css" >
	<link rel="stylesheet" href="<?php echo base_url(); ?>styles/adminica/colours.css"> 

	<script src="<?php echo base_url(); ?>scripts/adminica/adminica_all-min.js"></script>
</head>

<body>	
	<div id="pjax">

		<div id="wrapper">

			<div class="isolate">

				<div class="center narrow">

					<div class="main_container full_size container_16 clearfix">

						<div class="box">

							<div class="block">

								<div class="section">

									<div class="alert dismissible alert_light">

										<img width="24" height="24" src="<?php echo base_url(); ?>assets/img/hadoop-twitter-logo.png">
										<?php 
										if ( isset($err) )
										{
											echo $err; 
										}
										else
											echo "<strong>Welcome to TweetData.</strong> Please enter your info to login.";		

										?>
										
									</div>

								</div>

								<form action= <?php
								$this->load->helper('url');
								echo site_url("frontend_controller/validate_user");
								?> method="post">

								<fieldset class="label_side top">

									<label for="username_field">Email</label>
									<div>
										<input type="text" name="name" class="form-control" required autofocus>
									</div>

								</fieldset>

								<fieldset class="label_side bottom">

									<label for="password_field">Password</label>
									<div>
										<input type="password" class="form-control" name="password" required>
									</div>

								</fieldset>

								<div class="button_bar clearfix">
									<button class="wide" type="submit">
										<img src="<?php echo base_url(); ?>assets/img/key_2.png">
										<span>Login</span>
									</button>
									</form>
								</div>
								<form action="<?php echo base_url();?>frontend_controller/goto_usercreation" method="post">
									<div class="button_bar clearfix">
										<button class="wide" type="submit">
										<img src="<?php echo base_url(); ?>assets/img/user.png">
										<span>Register</span>
										</button>
									</div>
								</form>								

							
								<label><a href="#">Forgot your password?</a></label>
							
						</button>

						</div>
						
					</div>

				</div>

			</div>

		</div>

	</body>	
	</html>
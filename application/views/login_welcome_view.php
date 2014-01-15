<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to TweetData!</title>
	
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
								
								<a>Welcome <?php if (isset ($username)) echo $username; ?></a>

								<div class="image-container">
									<img src="<?php echo base_url(); ?>assets/img/hadoop-twitter-logo.png">
								</div>

								<div>
									<form action= <?php
									$this->load->helper('url');
									echo site_url("frontend_controller/goto_search");
									?> method="post">
									<div class="button_bar clearfix">
										<button class="wide" type="submit">
											<span>Go to Submit Form</span>
										</button>
									</div>
									<br>

								</form>

								<form action= <?php
								$this->load->helper('url');
								echo site_url("reportform");
								?> method="post">
								<div class="button_bar clearfix">
									<button class="wide" type="submit">
										<span>Go to Reports Form</span>
									</button>
								</div>
								<br>

							</form>

							<form <?php
							$this->load->helper('url');
							echo site_url("frontend_controller/home");
							?>>
							<div class="button_bar clearfix">
								<button class="wide" type="submit">
									<span>Back to Login Form</span>
								</button>
							</div>
							<br>

						</form>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>

</body>
</html>
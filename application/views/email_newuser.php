<html>


<body>
<h1>Welcome<?php echo $username ?></h1>
</br>
</br>
<h3>Click the following link to verify your account.</h3>
<a href="<?php if (isset($username)) echo base_url() ?>frontend_controller/home">Verfiy your Account!</a>
</body>
</html>
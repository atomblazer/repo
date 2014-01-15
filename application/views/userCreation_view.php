
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>TweetData UserCreation</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/normalize.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
  
  <style> 

  body {
    padding-top: 50px;
    padding-bottom: 10px;
    background-color: currentcolor;
    margin: 20px;
  }
  p{
    text-align: center;
    margin: 10px;
    color: white;
    font-style: italic;
  } 
  label{
    font-weight: inherit;
  }
  .jumbotron{
    background-color: #FFFFFF;
    box-shadow: 0px 7px 5px #000000;
    font-size: 14px;
  }
  .well{
    margin: 0px;
  }
  .alert-warning{
    padding: 0px;
    text-align: center;
  }
  .form-control {
    display: table-cell;
  }
  .image-container{
    text-align: center;
    width: 50px;
    height: 50px;
    float: left;
    margin-right: 25px;
  }   
  .image-container img{
    width: 100%;
    margin: 10px 20px;
  }
  .container .jumbotron {
    border-radius: 35px;
    padding: 30px;
  }
  .navbar-inverse .navbar-nav>li>a {
    color: #000;
  }
  .input-group{
    display: inherit;
  }
  .btn-primary {
    background-image: linear-gradient(to bottom,#7C9EB9 0,#1E8AEC 100%);
    background-repeat: repeat-x;
    text-align: center;
    border-color: #388AC0;
    width: 150px;
    height: 40px;
  }
  .navbar-inverse{
    background-image: linear-gradient(to bottom,#7DE4D0 0,#448083 100%);            }
    .navbar-inverse .navbar-brand {
      color: #FFF;
      }}
      .navbar-nav>li>a {
        color: #FFF;
      }
      </style>
    </head>

    <body>
      <div class="container">
        <div class="jumbotron">

          <div class="image-container"> 
            <img src="<?php echo base_url(); ?>assets/img/hadoop-twitter-logo.png"> 
          </div>

          <div class="well">


          <?php 
                    if ( isset($err) )
                    {
                      echo $err; 
                    }
                    else
                      echo "<h1>Welcome to Project TweetData</h1>"

            ?>
            
          </div>

          <form action="<?php echo base_url(); ?>frontend_controller/newuser" method="post">

           <div class="panel panel-default">
            <div class="panel-body">
              <h>Valid Email</h>
              <input type="text" name="name" class="form-control" required autofocus>
            </div>
          </div>
          

          <div class="panel panel-default">
            <div class="panel-body">
              <h>Password</h>
              <input type="password" class="form-control" name="password" required>
            </div>
          </div>
          
          <div class="panel panel-default">
          	<div class="panel-body">
          		<h>Re-enter Password</h>
          		<input type="password" class="form-control" name="re_pass" required>
          	</div>
          </div>

          <div class="panel panel-default">
            <div class="panel-body">
              <input type="submit" class="btn btn-primary pull-left" value = "Create a profile">

            </div>
          </div>

        </form>

        <div id="container" style="width: 100%; margin: 0 auto"></div>
      </div>
    </div> 

    <footer> 
      <p>&copy; Team TweetData 2013</p>
    </footer>


    <script src="http://twitterdata.brotskydesigns.com/frontend/oliver/login_v3/js/bootstrap.js"></script>  
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://twitterdata.brotskydesigns.com/frontend/oliver/login_v3/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="http://twitterdata.brotskydesigns.com/frontend/oliver/login_v3/js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="http://twitterdata.brotskydesigns.com/frontend/CodeIgniter/assets/js/jquery-1.10.2.min.js"></script>

  </body>
  </html>
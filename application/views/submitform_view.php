<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TwitterData Submission</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

  <?php
  $this->load->helper('html');
  $this->load->helper('utility_helper');
  $this->load->library('javascript');
  echo css('normalize');
  echo css('bootstrap.min');
  echo css('main');

  ?>
  <script src="<?php echo base_url(); ?>assets/js/modernizr-2.6.2.min.js"></script>

</head>

<body>
  <div class="navbar navbar-inverse navbar-fixed-top">
   <div class="container">
     <div class="navbar-header">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <div class="image-container">
        <img src="<?php echo base_url(); ?>assets/img/hadoop-twitter-logo.png" >
      </div>

      <a class="navbar-brand" href="#">Project TweetData</a>
    </div>

    <div class="navbar-collapse collapse" style="position:relative;">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Search</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
      <li style="position: absolute; right: 75px;"> <a href="#profile">Welcome <?php if (isset ($username)) echo $username; ?></a></li>
            <li> <a href="<?php echo base_url()?>frontend_controller/logout">Logout</a></li>

      
      </ul>
      
    </div>
  </div>
</div><!-- end of nav bar -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<div class= "model">
 <form name="myForm" class="form-horizontal" action=<?php
 $this->load->helper('url');
 echo site_url("frontend_controller/start_search");
 ?>  onsubmit="return validateForm();" method="post">
 <div class="submit-model-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <div class="modal-title">
      <h4>Search</h4>
    </div>
  </div>
    <div class="submit-modal-body">
      <div class="form-group">

        <label for="Search Terms">Search Terms<br /></label>
        <input type="text" name="searchTerms" class="form-control input-lg" placeholder="Enter Search Terms Here">  
      </div>

      <div class="form-group">

        <label for="idTag">ID TAG<br /></label>
        <input type="text" name="search_id" class="form-control input-lg" placeholder="Enter Id Tag Here">  
      </div>
      
      <div><p class="description">Once you enter your search term(s), select a search type. Stream shows incoming tweets for a set period of time. Rest shows existing tweets between two given dates.</p></div>
      <!-- End part 1 edits -->
      <div class="form-group">
        <select name="apitype" id="apitype" onchange="apiChange()">
          <label for="API">Choose the an API<br /></label>
          <option value=""></option>
          <option value="stream">Stream</option>
          <option value="rest">REST</option>
        </select>
      </div>

     
      <div id="input_area" style="margin: 10px">
        <div id ="stream_prompt" style="display:none">
          <div class="form-group">

            <label for="streamTime">Enter time period in seconds (up to 600 seconds for now)<br /></label>
            <input type="text" name="stream_value" id="stream_value" class="form-control input " placeholder="Enter Time Here"> 
            <label for="maxTweets">Enter max number of Tweets<br /></label>
            <input type="text" name="max_tweets_stream" id="max_tweets_stream" class="form-control input " placeholder="Enter maximum number of tweets">  
     
    
        </div>


      </div>

      <div id ="rest_prompt" style="display:none">
          <div class="form-group">

            <label for="restTime">Enter how many days to go back (up to 7 days)<br /></label>
            <input type="text" name="rest_value" id="rest_value" class="form-control input " placeholder="Enter Days Here"> 
            <label for="maxTweets">Enter max number of Tweets<br /></label>
            <input type="text" name="max_tweets_rest" id="max_tweets_rest" class="form-control input " placeholder="Enter maximum number of tweets">  
     
    
            </div>


      </div>


      <div class="form-group">
        <select name="reportType" id="reportType">
          <label for="Report">Choose the a Report type<br /></label>
          <option value="">Select Report Type</option>
          <option value="heatMap">HeatMap</option>
          <option value="pieChart">PieChart</option>
        </select>
      </div>
       
      </div>
      <!-- End part 2 edits -->
    </div>
  </div>
</div>
<input type="submit" class="btn btn-primary" value = "Submit Test">
</form>
</div>

<br>

<div>
  <form action="<?php echo base_url();?>reportform" method="post">
    <input type="submit" class="btn btn-primary" value = "View a report">
  </form> 
</div>

<div class="container-fluid">
  <footer>
    <p>&copy; Team TweetData 2013</p>
  </footer>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmoNGW2HYowmggOcL0Gxn69qP0ztQ4DHQ&sensor=true">
</script>


</body>
</html>
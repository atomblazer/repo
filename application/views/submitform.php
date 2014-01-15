<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TwitterData Submission</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

  <?php
  echo css('normalize');
  echo css('main');
  echo css('bootstrap.min');
  ?>
  <script src="http://twitterdata.brotskydesigns.com/frontend/CodeIgniter/assets/js/modernizr-2.6.2.min.js"></script>
  <?php
  echo css('bootstrap-theme.min');
  echo css('styles');
  ?>

  <script src="http://twitterdata.brotskydesigns.com/frontend/CodeIgniter/assets/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <script src="//code.jquery.com/jquery.js"></script>
  <script src="http://twitterdata.brotskydesigns.com/frontend/CodeIgniter/assets/js/bootstrap.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="http://twitterdata.brotskydesigns.com/frontend/CodeIgniter/assets/js/jquery-1.10.2.min.js"><\/script>')</script>
  <script src="http://twitterdata.brotskydesigns.com/frontend/CodeIgniter/assets/js/plugins.js"></script>
  <script src="http://twitterdata.brotskydesigns.com/frontend/CodeIgniter/assets/js/main.js"></script>

  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />

  <script type="text/javascript"
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmoNGW2HYowmggOcL0Gxn69qP0ztQ4DHQ&sensor=true">
  </script>

  <style>
  body {
    padding-top: 50px;
    padding-bottom: 10px;
    background-color: lightseagreen;
    margin: 20px;
  }
  html {
    background-color: lightseagreen;
  }
  p{
    text-align: center;
    margin: 10px;
    color: white;
    font-style: italic;
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
      }
      .navbar-nav>li>a {
        color: #FFF;
      }
      
    .description {
        font-size: 20px;
        color: #000;
        font-style: normal;
    }
      </style>

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
            <img src="http://twitterdata.brotskydesigns.com/frontend/CodeIgniter/assets/img/hadoop-twitter-logo.png" >
          </div>
          <a class="navbar-brand" href="#">Project TweetData</a>
        </div>
        
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Search</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <form class="container" style="margin: 50px" action=
      <?php
        $this->load->helper('url');
        echo site_url("frontend_controller/start_search");
       ?>  method="post">
      <div class="input-group input-group" >
       <span class="input-group-addon">Search</span>
       <input type="text" name="searchTerms" class="form-control input-lg" placeholder="Enter Search Terms Here">

     </div>
     <!-- Edits by Chris, part 1 -->
     <div><p class="description">Once you enter your search term(s), select a search type. Stream shows incoming tweets for a set period of time. Rest shows existing tweets between two given dates.</p><div>
      <!-- End part 1 edits -->
    <div class="btn-group" data-toggle="buttons-radio">
        <label class="btn btn-primary">
            <input type="radio" name="apitype" id="stream" value="stream">
            Stream
        </label>
        
        <label class="btn btn-primary">
            <input type="radio" name="apitype" id="rest" value="rest">
            Rest
        </label>
    </div>
<input type="hidden" name="option" value="" id="btn-input" />
<div class="btn-group" data-toggle="buttons">
  <label class="btn btn-primary">
    <input type="radio" name="options" id="option1" value="1"> Option 1
  </label>
  <label class="btn btn-primary">
    <input type="radio" name="options" id="option2" value="2"> Option 2
  </label>
  <label class="btn btn-primary">
    <input type="radio" name="options" id="option3"> Option 3
  </label>
</div>

    <!-- Edits by Chris, part 2 -->
    <div id="input_area" style="margin: 10px">
      <div id ="stream_prompt" style="display:none">
        <h3 id="description">Enter the total time to display and select the time unit:</h3>
        <input type="text" name="stream_value" id="stream_value" style="width:64px" />
        <select id="stream_unit">
          <option value="1">seconds</option>
          <option value="60">minutes</option>
          <option value="3600">hours</option>
          <option value="86400">days</option>
          <option value="604800">weeks</option>
          <option value="2419200">28-day months</option>
          <option value="2505600">29-day months</option>
          <option value="2592000">30-day months</option>
          <option value="2678400">31-day months</option>
          <option value="31536000">365-day years</option>
          <option value="31622400">366-day years</option>
        </select>
      </div>

      <div id ="rest_prompt" style="display:none">
        <h3 id="description">Select the beginning display date and time:</h3>
        <input type="text" name="rest_start_date" id="rest_start_date" style="width:84px" />
        <select id="rest_start_hour">
          <option value="00">(am) 12</option><option value="01">(am) 01</option><option value="02">(am) 02</option><option value="03">(am) 03</option>
          <option value="04">(am) 04</option><option value="05">(am) 05</option><option value="06">(am) 06</option><option value="07">(am) 07</option>
          <option value="08">(am) 08</option><option value="09">(am) 09</option><option value="10">(am) 10</option><option value="11">(am) 11</option>
          <option value="12">(pm) 12</option><option value="13">(pm) 01</option><option value="14">(pm) 02</option><option value="15">(pm) 03</option>
          <option value="16">(pm) 04</option><option value="17">(pm) 05</option><option value="18">(pm) 06</option><option value="19">(pm) 07</option>
          <option value="20">(pm) 08</option><option value="21">(pm) 09</option><option value="22">(pm) 10</option><option value="23">(pm) 11</option>
        </select>
        <select id="rest_start_minute">
          <option value="00">:00</option><option value="05">:05</option><option value="10">:10</option><option value="15">:15</option>
          <option value="20">:20</option><option value="25">:25</option><option value="30">:30</option><option value="35">:35</option>
          <option value="40">:40</option><option value="45">:45</option><option value="50">:50</option><option value="55">:55</option>
        </select>
        <h3 id="description">Select the ending display date and time:</h3>
        <input type="text" name="rest_end_date" id="rest_end_date" style="width:84px" />
        <select id="rest_end_hour">
          <option value="00">(am) 12</option><option value="01">(am) 01</option><option value="02">(am) 02</option><option value="03">(am) 03</option>
          <option value="04">(am) 04</option><option value="05">(am) 05</option><option value="06">(am) 06</option><option value="07">(am) 07</option>
          <option value="08">(am) 08</option><option value="09">(am) 09</option><option value="10">(am) 10</option><option value="11">(am) 11</option>
          <option value="12">(pm) 12</option><option value="13">(pm) 01</option><option value="14">(pm) 02</option><option value="15">(pm) 03</option>
          <option value="16">(pm) 04</option><option value="17">(pm) 05</option><option value="18">(pm) 06</option><option value="19">(pm) 07</option>
          <option value="20">(pm) 08</option><option value="21">(pm) 09</option><option value="22">(pm) 10</option><option value="23">(pm) 11</option>
        </select>
        <select id="rest_end_minute">
          <option value="00">:00</option><option value="05">:05</option><option value="10">:10</option><option value="15">:15</option>
          <option value="20">:20</option><option value="25">:25</option><option value="30">:30</option><option value="35">:35</option>
          <option value="40">:40</option><option value="45">:45</option><option value="50">:50</option><option value="55">:55</option>
        </select>
        <h3 id="description">Remember: The ending date/time is AFTER the beginning date/time!</h3>
      </div>
    </div>
    <!-- End part 2 edits -->
  <input type="submit" class="btn btn-primary" value = "Submit Test">
</form>



  <div class="container-fluid">
    <div class="row-fluid">

        <div class="hero-unit">
          <div class="btn-group" data-toggle="buttons-radio">
            <label class= "btn btn-primary">
                <input type="radio" name "geo" id="NoGeo" >Don't Use Location
            </label>

            <label class= "btn btn-primary">
               <input type="radio" name "geo" id="MyGeo" >Use My Location

            </label>

            <label class= "btn btn-primary">
               <input type="radio" name "geo" id="CustomGeo">Input Location

            </label>
              
          </div>
            <div id="custominput">
              <input type="text" name="custom" id="latitude" class="form-control input " placeholder="Enter Latidude" style= "width : 120px;display:none" >
              <input type="text" name="custom" id="longitude" class="form-control input " placeholder="Enter Longitude" style= "width : 120px;display:none" >
              <input type="text" name="custom" id="radius" class="form-control input " placeholder="Enter Radius" style= "width : 120px;display:none" >
            <form action="http://twitterdata.brotskydesigns.com/frontend/CodeIgniter/login" method="post">
              <input type="submit" class="btn btn-primary" id="apply" value = "apply" style="display:none">
            </form>
            </div>
            
      </div>
      
      <div id="map-canvas" style="height:400px;margin-bottom:100px;display:none" ></div>

    </div>
    <div>
      <form action=
      <?php
        $this->load->helper('url');
        echo site_url("frontend_controller/start_search");
       ?>  method="post">
        <input type="submit" class="btn btn-primary" value = "Submit Report">
      </form>
      <br>
    </div>

    <div>
      <form action="http://twitterdata.brotskydesigns.com/frontend/CodeIgniter/report" method="post">
        <input type="submit" class="btn btn-primary" value = "View Report">
      </form>
      <br>
      <form action="http://twitterdata.brotskydesigns.com/frontend/CodeIgniter/login" method="post">
        <input type="submit" class="btn btn-primary" value = "Log Out">
      </form>
    </div>

    <footer> 
     <p>&copy; Team TweetData 2013</p>
   </footer>

 </div>

</body>
</html>
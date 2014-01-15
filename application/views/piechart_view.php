<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>TweetData Reports</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
    
    <script>window.jQuery || document.write('<script src="<?php echo base_url();?>assets/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
    <script src="<?php echo base_url();?>assets/js/plugins.js"></script>
    <script src="<?php echo base_url();?>assets/js/main.js"></script> 
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>


        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript">
        $(function () {
                    $('#container').highcharts({
                        chart: {
                            type: 'pie'
                        },

                        
                        title: {
                            text: "Sentiment analysis for <?php echo $count; ?> tweets containing: <?php echo $terms; ?>"
                        },
                        
                        xAxis: {
                            categories: ['Neutral', 'Positive', 'Negative']
                        },

                
                        plotOptions: {
                            pie: { allowPointSelect: true,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.name}: {point.percentage: .1f}%'
                                    } }
                        },
                        
                        series: [{
                            data: [['Neutral', <?php echo $neu; ?>], ['Positive', <?php echo $pos; ?>], ['Negative', <?php echo $neg; ?>]]
                        }]
                    });
        });
</script>

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
          <img src="<?php echo base_url();?>assets/img/hadoop-twitter-logo.png" >
      </div>
      <a class="navbar-brand" href="#">Project TweetData</a>
  </div>
  
  
  <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Reports</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
</div>
</div>
</div>

<div>
    <pre> Prototype tables will go here </pre>

    <body>
        <script src="<?php echo base_url();?>assets/js/highcharts/highcharts.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/highcharts/themes/grid.js"></script>
        <script src="<?php echo base_url();?>assets/js/highcharts/modules/exporting.js"></script>
        <div id="container" style="width: 100%; margin: 0 auto"></div>
        <br>

        <form action="<?php echo base_url();?>frontend_controller/goto_search" method="post">
            <input type="submit" class="btn btn-primary" value = "Return to search">
        </form>
        <br>

        <form action="<?php echo base_url();?>frontend_controller/home" method="post">
            <input type="submit" class="btn btn-primary" value = "Log Out">
        </form> 

    </body>

    <br>

    <footer> 
      <p>&copy; Team TweetData 2013</p>
  </footer>

</div> 

</body>
</html>
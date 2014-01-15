$ = jQuery;
 var lat = 0;
  var lng = 0;
    var radius = 10000;
 var circlemap;
var api;

  
 /* if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      lat  = position.coords.latitude;
      lng = position.coords.longitude;
      initialize();
    });
  }
  */
function validateForm(){
var x = document.forms["myForm"]["stream_value"].value;
if (X>600) {

  alert("Time is too great");
  return false;
}

}


function apiChange(){

  if ( document.getElementById("apitype").value == "stream" ) 
  {
      
      document.getElementById("rest_prompt").style.display ='none';
      document.getElementById("stream_prompt").style.display ='block';

  } 
  if (document.getElementById("apitype").value == "rest" )
  {
    

      document.getElementById("stream_prompt").style.display ='none';
      document.getElementById("rest_prompt").style.display ='block';
  }
  if ( document.getElementById("apitype").value == "" )
  {
  
      document.getElementById("stream_prompt").style.display ='none';
      document.getElementById("rest_prompt").style.display ='none';
  }

  

}



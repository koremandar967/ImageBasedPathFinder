<?php
if(isset($_GET['Lat']) and isset($_GET['Log']))
{
?>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTdxOIiUh1ehTRUyaSYKBBkHSYPDYB22I&callback=initMap"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<body>

<input id="LAT" type="hidden" value="<?php echo $_GET['Lat'];?>" >
<input id="LAG" type="hidden" value="<?php echo $_GET['Log'];?>" >


<script type="text/javascript">
var geocoder = new google.maps.Geocoder();
var abcd = parseFloat(0.000001);
var latnew="";
var lagnew="";
var spdnew="";

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
  document.getElementById('info').innerHTML = [
    latLng.lat(),
    latLng.lng()
  ].join(', ');
}

function updateMarkerAddress(str) {
  document.getElementById('address').innerHTML = str;
}

function initialize() {
var cityCircle=new google.maps.Circle();
  var latLng = new google.maps.LatLng($("#LAT").val(),  $("#LAG").val());
  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom: 18,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var marker = new google.maps.Marker({
    position: latLng,
    title: 'Point A',
    map: map,
    draggable: true
  });


  // Update current position info.
  updateMarkerPosition(latLng);
  geocodePosition(latLng);

  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });

  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
  });

  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });


}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);

</script>






<style>
  #mapCanvas {
    width: 100%;
    height: 400px;
    float: left;

  }
</style>

  <div id="mapCanvas"></div>
  <hr>
 
<fieldset>
<legend><b>My Location</b></legend>
  <div id="infoPanel">
    <b>Current position:</b>
    <div id="info"></div>
    <b>Closest matching address:</b>
    <div id="address"></div>
  </div>
</fieldset>
 

</body>
</html>
<?php
}
?>
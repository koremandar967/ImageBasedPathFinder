<?php
if(isset($_GET['LAT']) and isset($_GET['LOG']))
{
?>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Travel modes in directions</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
  </head>

  	<script async defer  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDN5NuRN9Sa3bCBBM1Fxb7QhocrAkJ28e8&callback=initMap"></script>
 

<body>
<input id="LAT" type="hidden" value="<?php echo $_GET['LAT'];?>" >
<input id="LAG" type="hidden" value="<?php echo $_GET['LOG'];?>" >
<input id="LAT1" type="hidden" value="<?php echo $_GET['LAT1'];?>" >
<input id="LAG1" type="hidden" value="<?php echo $_GET['LOG1'];?>" >

 <div id="floating-panel">
    <b>Mode of Travel: </b>
    <select id="mode">
      <option value="DRIVING">Driving</option>
      <option value="WALKING">Walking</option>
      <option value="BICYCLING">Bicycling</option>
	  <option value="TRANSIT">Transit</option>
    </select>
    </div>
    <div id="map"></div>
    <script>
      function initMap() {
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: document.getElementById('LAT').value+","+document.getElementById('LAG').value
        });
        directionsDisplay.setMap(map);

        calculateAndDisplayRoute(directionsService, directionsDisplay);
        document.getElementById('mode').addEventListener('change', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var selectedMode = document.getElementById('mode').value;
        directionsService.route({
          origin: document.getElementById('LAT').value+","+document.getElementById('LAG').value,  // Haight.
          destination: document.getElementById('LAT1').value+","+document.getElementById('LAG1').value,  // Ocean Beach.
          // Note that Javascript allows us to access the constant
          // using square brackets and a string value as its
          // "property."
          travelMode: google.maps.TravelMode[selectedMode]
        }, function(response, status) {
          if (status == 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>


 

</body>
</html>
<?php
}
?>
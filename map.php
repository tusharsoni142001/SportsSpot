<?php
  session_start();
  include ("dbcon.php"); 

  if (isset($_GET['id'])) {
    // Retrieve the user ID from the URL parameter
    $id = $_GET['id'];
  // Retrieving latitude and longitude from databse
  $query="select name,longitude,latitude from sports_complex where complexID=$id";
  $result=mysqli_query($conn,$query);
  $row=mysqli_fetch_array($result);
  $name=$row['name'];
  $latitude=$row['latitude'];
  $longitude=$row['longitude'];
  }

?>
<!DOCTYPE html>
<html>
<head>


  <title>Complex Location | Manager</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

  <!-- Leaflet routing machine css-->
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

  <style>
    body {
      margin: 0;
      padding: 0;
    }
  </style>
</head>
<body>
  <div id="map" style="width:100%; height:100vh"></div>
</body>
<!-- leaflet js cdn-->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<!-- Leaflet routing machine js-->
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

<script>
var map = L.map('map').setView([<?php echo $latitude?>, <?php echo $longitude?>], 14.5);
var tileLayer = L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', { attribution: "OSM" }).addTo(map);

function getPosition() {
  return new Promise(function(resolve, reject) {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(resolve, reject);
    } else {
      reject(new Error("Geolocation is not supported by this browser."));
    }
  });
}

async function updateMap() {
  try {
    var position = await getPosition();
    var latitude = <?php echo $latitude?>;
    var longitude = <?php echo $longitude?>;
    var name = <?php echo json_encode($name); ?>;
    
    console.log(latitude + " " + longitude);

    var marker = L.marker([latitude, longitude], {
      title: name
    }).addTo(map);

   

    // Get user's current position
    var userLat = position.coords.latitude;
    var userLng = position.coords.longitude;
    map.setView([userLat, userLng], 14.5);

    // Add a marker for user's current position
    var userMarker = L.marker([userLat, userLng], {
      title: "Your Location"
    }).addTo(map);

    // Add routing control with waypoints
    L.Routing.control({
      waypoints: [
        L.latLng(userLat, userLng),
        L.latLng(latitude, longitude)
      ]
    }).addTo(map);
  } catch (error) {
    alert("Error code: " + error.code + ";\n Message: " + error.message);
  }
}

updateMap();




</script>
</html>

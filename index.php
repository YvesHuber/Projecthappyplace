<?php
ini_set('user_agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "happyplace";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM places";
$result = $conn->query($sql);

// create curl resource
$ch = curl_init();

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
if ($result->num_rows > 0) {

    // output data of each row
    while ($row = $result->fetch_assoc()) {

        echo " Ort: " . $row["name"];
        echo " ";
        curl_setopt($ch, CURLOPT_URL, "https://nominatim.openstreetmap.org/search?q=" . $row["name"] . "&format=json");
        $output = curl_exec($ch);
        printf($output);
    }
} else {
    echo "0 results";
}
echo curl_error($ch);


// close curl resource to free up system resources
curl_close($ch);
$conn->close();
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>OpenLayers Demo</title>
    <style type="text/css">
        html,
        body,
        #basicMap {
            width: 100%;
            height: 100%;
            margin: 0;
        }
    </style>
    <script src="OpenLayers.js"></script>
    <script>
        function init() {
            map = new OpenLayers.Map("basicMap");
            var mapnik = new OpenLayers.Layer.OSM();
            var fromProjection = new OpenLayers.Projection("EPSG:4326"); // Transform from WGS 1984
            var toProjection = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
            var position = new OpenLayers.LonLat(8.52, 47.36).transform(fromProjection, toProjection);
            var zoom = 10;

            map.addLayer(mapnik);
            map.setCenter(position, zoom);
        }
    </script>
</head>

<body onload="init();">
    <div id="basicMap"></div>
</body>

</html>
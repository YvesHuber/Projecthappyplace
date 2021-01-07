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
$lat = "SELECT latitude, longitude FROM places";
$result = $conn->query($sql);
$resultla = $conn->query($lat);

// create curl resource
$ch = curl_init();

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
start:
// $output contains the output string
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo " Ort: " . $row["name"];
        echo " ";
        printf($output);
    }
} else {
    echo "0 results";
}

if ($resultla->num_rows > 0) {
    while ($row = $resultla->fetch_assoc()) {
        echo " lat: " . $row["latitude"] . " long: " . $row["longitude"];
        $a = $row["latitude"];
        $b = $row["longitude"];
        printf($output);
    }
} else {
    echo "0 results";
}

echo curl_error($ch);

// close curl resource to free up system resources

?>
<!DOCTYPE HTML>
<html>

<head>
    <title>OpenLayers Demo</title>
    <link rel="stylesheet" href="/Assets/style.css">
    <style type="text/css">
        html,
        body,
        #basicMap {
            width: 75%;
            height: 75%;
            margin: 0;
        }
    </style>
    <script>
            function add_map_point(lng, lat) {
            var vectorLayer = new ol.layer.Vector({
                source: new ol.source.Vector({
                    features: [new ol.Feature({
                        geometry: new ol.geom.Point(ol.proj.transform([parseFloat(lng), parseFloat(lat)], 'EPSG:4326', 'EPSG:3857')),
                    })]
                }),
                style: new ol.style.Style({
                    image: new ol.style.Icon({
                        anchor: [0.5, 0.5],
                        anchorXUnits: "fraction",
                        anchorYUnits: "fraction",
                        src: "https://upload.wikimedia.org/wikipedia/commons/e/ec/RedDot.svg"
                    })
                })
            });
            map.addLayer(vectorLayer);
            console.log(lat);
        }

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
    <script src="OpenLayers.js"></script>
    <script>
        var lat2 = <?php echo $a; ?>;
        var lng2 = <?php echo $b; ?>;
        console.log (lat2);
        console.log (lng2);
    </script>
</head>

<body onload="init(); add_map_point(lat2, lng2);">
    <div id="basicMap"></div>
    </body>

</html>
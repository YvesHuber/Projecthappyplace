
<!DOCTYPE html>
<html>

<head>
    <title>OpenLayers Demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js"></script>
    <script>
        function add_map_point(lng, lat) {
            var layer = new ol.layer.Vector({
                source: new ol.source.Vector({
                    features: [
                        new ol.Feature({
                            geometry: new ol.geom.Point(ol.proj.fromLonLat([lng, lat]))
                        })
                    ]
                })
            });
            map.addLayer(layer);
        }


        function init() {
            return new ol.Map({
                target: 'basicMap',
                layers: [
                    new ol.layer.Tile({
                        source: new ol.source.OSM()
                    })
                ],
                view: new ol.View({
                    center: ol.proj.fromLonLat([8.510, 47.36]),
                    zoom: 4
                })
            });
        }
    </script>
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
$url = "SELECT icon FROM markers";
$result = $conn->query($sql);
$resultla = $conn->query($lat);
$resulturl = $conn->query($url);


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
    if ($row = $resultla->fetch_assoc()) {
        echo " lat: " . $row["latitude"]  . " long: " . $row["longitude"];
        $a = $row["latitude"];
        $b = $row["longitude"];
        printf($output);
    }
} else {
    echo "0 results";
}


// close curl resource to free up system resources

?>
</head>

<body>
    <div id="basicMap"></div>
    <script type="text/javascript">
        var map = init();
        lat2 = <?php echo $a; ?>;
        lng2 = <?php echo $b; ?>;
        
        add_map_point(lng2, lat2);
    </script>


    </div>
</body>

</html>